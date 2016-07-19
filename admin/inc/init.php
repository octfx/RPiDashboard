<?php

/**
 * Init File
 * @version 1.0
 * @author Hannes Kruse fox@foxdev.io
 */
date_default_timezone_set("Europe/Berlin");
require_once 'lib/ErrorLib.php';
$absPath = __FILE__;
$absPath = str_replace('inc/init.php', '', $absPath);

try {
    $config = parse_ini_file($absPath . 'config.ini.php');
    if ($config !== false) {

        /**
         * Path to Basedir
         */
        define('protocol', $config["protocol"]);

        /**
         * Path to Basedir
         */
        define('basedir', $config["basedir"]);


        if (substr($config["basedirhttp"], -1) == '/') {
            define('basedirhttp', $config["basedirhttp"]);
        }
        else {
            die("Trailing slash is missing!<br />basedirhttp is: " . $config["basedirhttp"] . " - should be " . $config["basedirhttp"] . "<strong>/</strong>");
        }

        //Database
        /**
         * Database Name
         */
        define('sqlName', $config["sqlName"]);

        /**
         * Database Host
         */
        define('sqlHost', $config["sqlHost"]);

        /**
         * DatabaseUser
         */
        define('sqlUser', $config["sqlUser"]);

        /**
         * Database Password
         */
        define('sqlPass', $config["sqlPass"]);

        /**
         * Database Port
         */
        define('sqlPort', $config["sqlPort"]);

        /**
         * Tables
         */
        define('TODO_TABLE', $config["todoTable"]);
        define('TODO_USER_TABLE', $config["todoUserTable"]);
        define('BUY_TABLE', $config["buyTable"]);


        /**
         * Autoload of Classes
         * @access public
         * @param  string  $class_name Name of the class
         * @return boolean
         */
        function __autoload($class_name) {
            if (class_exists($class_name, false) || interface_exists($class_name, false)) {
                return true;
            }
            try {

                //$className validieren ...
                if (!preg_match('=^[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*$=m ', $class_name)) {
                    throw new Exception("Klasse '$class_name' ist ungültig!");
                }

                $pfad = "/admin/inc/classes/";

                // Existenz Prüfen
                $class_file = basedir . $pfad . $class_name . '.class.php';
                if (!is_file($class_file)) {
                    throw new Exception('Datei "' . $class_file . '" nicht gefunden!');
                }

                //Quelldatei laden
                require_once $class_file;

                // Klasse auch definiert?
                if (!class_exists($class_name)) {
                    throw new Exception("Datei '$class_file' enthät keine Klasse '$class_name'");
                }

                return true;
            }
            catch(Exception $e) {
                die($e->getMessage());
            }
        }

        // Database
        try {
            $DB = new MysqlDB();
            if (!in_array("MysqlDB", get_declared_classes())) {
                throw new ClassException("MysqlDB Class could not be loaded. Check the classes dir for MysqlDB.class.php", 1);
            }
        }
        catch(DatabaseException $e) {
            $e->plainHtmlDie();
        }
        $sql = $DB->getDBObj();
    }
    else {
        throw new initException("Could not read the ini File!", 1);
    }
    define( 'LOADED', true );
}
catch(initException $e) {
    $e->plainHtmlDie();
}
?>
