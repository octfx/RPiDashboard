<?php

/**
 * FunctionHelper Class
 * @version 1.0
 * @author Hannes Kruse fox@foxdev.io
 */

/**
 * FunctionHelper Class Code
 */
class FunctionHelper
{

    /**
     * Diff arrays
     * @access public
     * @param  array $aArray1 Array to diff
     * @param  array $aArray2 Array to diff
     * @return array
     */
    public static function arrayRecursiveDiff($aArray1, $aArray2)
    {
        $aReturn = array();
        foreach ($aArray1 as $mKey => $mValue) {
            if (array_key_exists($mKey, $aArray2)) {
                if (is_array($mValue)) {
                    $aRecursiveDiff = $this->arrayRecursiveDiff($mValue, $aArray2[$mKey]);
                    if (count($aRecursiveDiff)) {
                        $aReturn[$mKey] = $aRecursiveDiff;
                    }
                } else {
                    if ($mValue != $aArray2[$mKey]) {
                        $aReturn[$mKey] = $mValue;
                    }
                }
            } else {
                $aReturn[$mKey] = $mValue;
            }
        }
        return $aReturn;
    }

    /**
     * Check if given string is a valid mail address
     * @access public
     * @param  string  $mail Mail to check
     * @return boolean
     */
    public static function isValidMail($mail)
    {
        if (preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $mail)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check if given string is a alphanumeric
     * @access public
     * @param  string  $string string to check
     * @return boolean
     */
    public static function isAlphaNum($string)
    {
        if (preg_match('/^[a-zA-Z0-9_-]*$/', $string)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check if given string is a valid url
     * @access public
     * @param  string  $url  url to check
     * @return boolean
     */
    public static function isUrl($url)
    {
        // if( filter_var( $url, FILTER_VALIDATE_URL ) ){ //Maybe not so good
        if (preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $url)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Define if server is on SSL
     * @access public
     * @return boolean
     */
    public static function isHTTPS()
    {
        if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * check if the visitor is requesting via https
     * @access public
     * @return boolean
     */
    public static function checkCFHttps()
    {
        if (!isset($_SERVER["HTTP_X_FORWARDED_PROTO"])) {
            return true;
        } else {
            if ($_SERVER["HTTP_X_FORWARDED_PROTO"] == 'http') {
                return false;
            } else {
                return true;
            }
        }
    }

    /**
     * Check if a given path is a dir and is writable
     * @param  string  $path Path to the Dir
     * @return boolean       true or false
     */
    public static function isDirWritable($path)
    {
        if (isset($path)) {
            if (is_dir($path) && is_writable($path)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * returns the filextension of a given filename
     * @param  string  $file_name name of the file
     * @return string file extension
     */
    public static function getFileExtension($file_name)
    {
        return substr(strrchr($file_name, '.'), 1);
    }
}
?>
