<?php
class Filter{

    /**
     * filters a string that can be used as a username
     * uses filter var, leaves only alphanumeric chars and -_ in place
     * @param string $username username
     * @return string username
     */
    public static function FilterAlphaNum($string)
    {
        if (!empty($string)) {
            $string = trim($string,'-_');
            $string = filter_var($string, FILTER_SANITIZE_STRING , FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_LOW);
            $string = preg_replace("/[^a-zA-Z0-9\-\_]+/", "", $string);
            $string = str_replace(' ', '-', $string);
            $string = rtrim($string, '-_');
            $string = ltrim($string, '-_');
            return $string;
        } else {
            throw new Exception( 'parameter must not be empty' );
        }
    }

    public static function FilterUsername($username)
    {
        return Filter::FilterAlphaNum($username);
    }

    /**
     * trims and filters a email adress
     * @param string $mail mail adress
     * @return string filtered mail
     */
    public static function FilterMail($mail)
    {
        if (!empty($mail)) {
            $mail = trim($mail);
            $mail = strtolower($mail);
            $mail = filter_var($mail, FILTER_SANITIZE_EMAIL);
            return $mail;
        } else {
            throw new Exception( 'parameter must not be empty' );
        }
    }


        /**
         * filters a string that can be used as a route
         * uses filter var, leaves only alphanumeric chars and / in place
         * @param string $route route
         * @return string route
         */
        public static function FilterRoute($route)
        {
            if (!empty($route)) {
                $route = trim($route,'-_');
                $route = preg_replace("/[^a-zA-Z0-9\/\.\_]+/", "", $route);
                $route = str_replace(' ', '-', $route);
                $route = rtrim($route, '-_');
                $route = ltrim($route, '-_');
                return $route;
            } else {
                throw new Exception( 'parameter must not be empty' );
            }
        }
}
?>
