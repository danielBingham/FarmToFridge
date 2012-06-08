<?PHP

abstract class Application_Service_Payment_Abstract {

    public abstract function initialize();
    public abstract function handleSuccess();
    public abstract function handleCancel();
    public abstract function handleFailure();

}

?>
