<?Php 

class Application_Model_Builder_FarmImage extends Application_Model_Builder_Abstract {

    // {{{ __construct()
    
    public function __construct() {
        $this->haveBuilt = array(
            'farm'=>false,
            'image'=>false 
        );
    }

    // }}}

    // {{{ buildFarm(Application_Model_FarmImage $farmImage):               public void

    public function buildFarm(Application_Model_FarmImage $farmImage) {
        if($farmImage->farmID === false) {
            throw new RuntimeException('FarmImage->farmID must be set in order to load Farm.');
        } 

        $farmImage->setFarm(Application_Model_Query_Farm::getInstance()->get($farmImage->farmID));
    }

    // }}}
    // {{{ buildImage(Application_Model_FarmImage $farmImage):              public void

    public function buildImage(Application_Model_FarmImage $farmImage) {
        if($farmImage->imageID === false) {
            throw new RuntimeException('FarmImage->imageID must be set in order to load Image.');
        }
        $farmImage->setImage(Application_Model_Query_Image::getInstance()->get($farmImage->imageID));
    }

    // }}}
}

?>
