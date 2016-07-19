<?php

/**
 * DB Class
 * @version 1.0
 * @author Hannes Kruse fox@foxdev.io
 */

/**
 * DB Class Code
 */
class DB
{

    /**
     * @var string $_sqlName Databse Name
     */
    protected $_sqlName;

    /**
     * @var string $_sqlHost Database Host
     */
    protected $_sqlHost;

    /**
     * @var string $_sqlUser Database Username
     */
    protected $_sqlUser;

    /**
     * @var string $_sqlPass Database Password
     */
    protected $_sqlPass;

    /**
     * @var integer $_sqlPort Database Port
     */
    protected $_sqlPort;

    /**
     * @var object $_db DB Object
     */
    protected $_db;

    /**
     * @var string $_lastQuery Last Query
     */
    protected $_lastQuery;

    /**
     * @var string $_lastQueryResult Last Queryresult
     */
    protected $_lastQueryResult;

    /**
     * @var integer $_lastInsertID Last inserted ID
     */
    protected $_lastInsertID;

    protected static $_instance = null;

    /**
     * Returns a DB Object
     * @access public
     * @return object
     */
    public function getDBObj()
    {
        return $this->_db;
    }

    /**
     * Sets the last Query
     * @access public
     * @param  string  $query  last query
     * @return void
     */
    public function setLastQuery($query)
    {
        if (!empty($query)) {
            if (logDB == 1) {
                $this->_lastQuery.= "\n" . SqlFormatter::format($query);
            }
        } else {
            throw new Exception('$query parameter not set');
        }
    }

    /**
     * Sets the last Queryresult
     * @access public
     * @param  string  $queryResult  last queryresult
     * @return void
     */
    public function setLastQueryResult($queryResult)
    {
        $this->_lastQueryResult = $queryResult;
    }

    /**
     * Sets the last insert ID
     * @access public
     * @param  integer $id   last insert ID
     * @return void
     */
    public function setLastInsertID($id)
    {
        $id = intval($id);
        $this->_lastInsertID = $id;
    }

    /**
     * returns the last Query
     * @access public
     * @return string
     */
    public function getLastQuery()
    {
        return $this->_lastQuery;
    }

    /**
     * returns the last Queryresult
     * @access public
     * @return string
     */
    public function getLastQueryResult()
    {
        return $this->_lastQueryResult;
    }

    /**
     * returns the last Insert ID
     * @access public
     * @return integer
     */
    public function getLastInsertID()
    {
        return $this->_lastInsertID;
    }


    /**
    * basic query wrapper to set the last query and result
    * @access public
    * @param string $query sql query
    * @param integer $fetch flag if the result should be fetched
    * @return mixed
    */
    public function query($query, $fetch=0)
    {
        if (!empty($query)){
            $queryResult = $this->_db->query($query);
            switch ($fetch) {
                case 0:
                    return $queryResult;
                    break;

                case 1:
                    return $queryResult->fetch_array(MYSQLI_ASSOC);;
                    break;

                case 2:
                    return $queryResult->fetch_array(MYSQLI_NUM);;
                    break;

                case 3:
                    return $queryResult->fetch_array(MYSQLI_BOTH);;
                    break;

                case 4:
                    return mysqli_fetch_all($queryResult,MYSQLI_ASSOC);
                    break;

                default:
                    # code...
                    break;
            }

        }
    }
}
?>
