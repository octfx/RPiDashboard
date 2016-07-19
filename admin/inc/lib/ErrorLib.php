<?php

/**
 * @Author: Hannes
 * @Date:   2014-12-09 17:50:54
 * @Last Modified by:   Hannes
 * @Last Modified time: 2015-05-10 13:52:54
 */

/**
 * Added extra Functions to the Exception Class
 */
class ExceptionExtra extends Exception
{
    protected $_fatal;

    public function plainHtmlDie() {
        die('<h3>Exception</h3><strong>Error:</strong> ' . $this->message . "<br />" . "<strong>Errorcode</strong>: " . $this->code);
    }

    public function alertHtml() {
        $alert = '  <div class="alert alert-dismissable alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4>' . $Translation->__('Fehlercode') . ': ' . $this->code . '
                        </h4>' . $this->message . '
                    </div>';
    }

    public function __toString() {
        if ($this->_fatal == 1) {
            die("Error: [{$this->code}]: {$this->message}\n");
        }
        else {
            echo "Error: [{$this->code}]: {$this->message}\n";
        }
    }

}

/**
 * ErrorClass for the init Script
 */
class initException extends ExceptionExtra
{
    public function __construct($message, $fatal = 0, $code = 0) {
        parent::__construct($message, $code);
        $this->_fatal = intval($fatal);
    }
}

/**
 * ErrorClass for the Cache Class
 */
class CacheException extends ExceptionExtra
{
    public function __construct($message, $fatal = 0, $code = 0) {
        parent::__construct($message, $code);
        $this->_fatal = intval($fatal);
    }
}

/**
 * ErrorClass for the Error Class (yeah...)
 */
class ErrorCException extends ExceptionExtra
{
    public function __construct($message, $fatal = 0, $code = 0) {
        parent::__construct($message, $code);
        $this->_fatal = intval($fatal);
    }
}

/**
 * ErrorClass for MySQLDB
 */
class DatabaseException extends ExceptionExtra
{
    public function __construct($message, $fatal = 0, $code = 0) {
        parent::__construct($message, $code);
        $this->_fatal = intval($fatal);
    }
}
?>
