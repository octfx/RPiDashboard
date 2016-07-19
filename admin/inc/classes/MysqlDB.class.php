<?php

/**
 * MysqlDB Class
 * @version 1.0
 * @author Hannes Kruse fox@foxdev.io
 */

/**
 * MysqlDB Class Code
 */
class MysqlDB extends DB
{

    /**
     * __construct Function
     * @access public
     * @param  string  $_sqlName Database Name
     * @param  string  $_sqlHost Database Host
     * @param  string  $_sqlUser Database User
     * @param  string  $_sqlPass Database Password
     * @param  integer $_sqlPort Database Port
     */
    public function __construct($_sqlName = sqlName, $_sqlHost = sqlHost, $_sqlUser = sqlUser, $_sqlPass = sqlPass, $_sqlPort = sqlPort)
    {
        $this->_sqlName = $_sqlName;
        $this->_sqlHost = $_sqlHost;
        $this->_sqlUser = $_sqlUser;
        $this->_sqlPass = $_sqlPass;
        $this->_sqlPort = intval($_sqlPort);
        try {
            $this->_db = new mysqli($this->_sqlHost, $this->_sqlUser, $this->_sqlPass, $this->_sqlName, $this->_sqlPort);
            $this->_db->set_charset("utf8mb4");
            if ($this->_db->connect_errno) {
                throw new DatabaseException("Couldn't connect to the Database: " . $this->_sqlName . " with Host: " . $this->_sqlHost, -101);
            }
            if (!$this->_db->select_db($this->_sqlName)) {
                throw new DatabaseException("Database $this -> _sqlName does not exist", -102);
            }
        }
        catch(Exception $e) {
            $e->plainHtmlDie();
        }
    }

    /**
     * MySQL Singleton Objekt
     * @return object               MySQL Object
     */
    public static function getInstance()
    {
        if (self::$_instance == null) {
            self::$_instance = new MysqlDB();
        }
        return self::$_instance;
    }
}
?>
