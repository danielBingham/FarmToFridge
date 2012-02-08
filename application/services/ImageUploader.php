<?php

class Application_Service_ImageUploader {
    private $errors = array();
    private $image;

    // {{{ getErrors():                                                     public array 

    public function getErrors() {
        return $this->errors;
    }

    // }}}
    // {{{ getImage():                                                      public Application_Model_Image 

    public function getImage() {
        return $this->image;
    }

    // }}}
    // {{{ createImageModel($height, $width, $userID):                      public Application_Model_Image

    private function createImageModel($height, $width, $userID) {
        $image = new Application_Model_Image();
        $image->height = $height;
        $image->width = $width;
        $image->userID = $userID;

        $persistor = new Application_Model_Persistor_Image();
        $persistor->save($image);

        return $image;
    }

    // }}}
    // {{{ haveUpload():                                                     public boolean
    
    public function haveUpload() {
        $uploader = new Zend_File_Transfer();
        return $uploader->isUploaded();
    }

    // }}} 
    // {{{ upload():                                                        public boolean

    public function upload() {
        if(!Zend_Auth::getInstance()->hasIdentity()) {
            throw new RuntimeException('Only logged in users may upload images.');
        }

        $fullImagePath = Zend_Registry::get('config')->paths->images->full;
        $uploadImagePath = Zend_Registry::get('config')->paths->images->upload;

        $uploader = new Zend_File_Transfer();
        $uploader->setDestination($uploadImagePath);
 
        if(!$uploader->receive()) {
            $errors = $uploader->getMessages();
            return false;
        }
        
        $filename = $uploader->getFileName('image');
        list($width, $height) = getimagesize($filename); 
        $image = $this->createImageModel($width, $height, Zend_Auth::getInstance()->getIdentity()->id);
 
        copy($filename, $fullImagePath . DIRECTORY_SEPARATOR . $image->id .'.jpg');
        unlink($filename);
        $this->resize($image);

        $this->image = $image;

        return true; 
    }

    // }}}
    // {{{ resize(Application_Model_Image $image):                          public boolean

	public function resize(Application_Model_Image $image) {
		$fullURL = Zend_Registry::get('config')->paths->images->full . DIRECTORY_SEPARATOR . $image->id . '.jpg';
        $largeURL = Zend_Registry::get('config')->paths->images->large . DIRECTORY_SEPARATOR . $image->id . '.jpg';	
	
		if(!file_exists($fullURL)) {
	        throw new RuntimeException('Attempting to resize an image that does not exist!');	
        }
		
		$gdImage = \imagecreatefromjpeg($fullURL);
		$size = getimagesize($fullURL);
		
		$x = 0;
		$y = 0;
		$baseWidth = $size[0];
		$baseHeight = $size[1];
		$height = $baseHeight;
		$width = $baseWidth;
			
		if($width > 1024) {
			$height = $height*1024/$width;	
			$width = 1024;
		}
		
		if($height > 768) {
			$width = $width*768/$height;
			$height = 768;	
		}
		
		$image->height = $height;
		$image->width = $width;
	
        $persistor = new Application_Model_Persistor_Image();
        $persistor->save($image);
	
		if($width == $baseWidth && $height == $baseHeight) {
			$gdResizedImage = $gdImage;	
		}
		else {
			$gdResizedImage = \imagecreatetruecolor($width, $height);
			\imagecopyresampled($gdResizedImage, $gdImage, 0, 0, $x, $y, $width, $height, $baseWidth, $baseHeight);
		}
		\imagejpeg($gdResizedImage, $largeURL);
		return true;
	}

    // }}}
    // {{{ crop(array $data):                                               public boolean
    	
	public function crop(Application_Model_Image $image, array $data) {
        $smallPath = Zend_Registry::get('config')->paths->images->small . DIRECTORY_SEPARATOR . $image->id . '.jpg';
        $mediumPath = Zend_Registry::get('config')->paths->images->medium . DIRECTORY_SEPARATOR . $image->id . '.jpg';
		$largePath = Zend_Registry::get('config')->paths->images->large . DIRECTORY_SEPARATOR . $image->id . '.jpg'; 
		$gdImage = imagecreatefromjpeg($largePath);
			
		$x = $data['x'];
		$y = $data['y'];
		$baseWidth = $data['width'];
		$baseHeight = $data['height'];
			
		$width = 200;
		$height = 200;
		$gdMedImage = imagecreatetruecolor($width, $height);

		imagecopyresampled($gdMedImage, $gdImage, 0, 0, $x, $y, $width, $height, $baseWidth, $baseHeight);
		
		imagejpeg($gdMedImage, $mediumPath);
			
		$width = 100;
		$height = 100;
			
		$gdSmallImage = imagecreatetruecolor($width, $height);
		imagecopyresampled($gdSmallImage, $gdImage, 0, 0, $x, $y, $width, $height, $baseWidth, $baseHeight);
		imagejpeg($gdSmallImage, $smallPath);

		return true;
	}

    // }}}

}


?>
