<?PHP

class Application_Service_Paginator_Adapter_Category_All
    extends Application_Service_Paginator_Adapter_Category_Abstract {

    public function __construct($order='name') {
        $select = Zend_Db_Table::getDefaultAdapter()->select();
        $select->from(
                array('categories'),
                array('*')
        );

        switch($order) {
            case 'name':
                $select->order('name asc');
                break;
            default:
                $select->order('name asc');
                break;
        }
        parent::__construct($select);
    }

}
