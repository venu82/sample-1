<?php

/**
 * This is Used for Core Database Activities
 * @category library
 * @package Database
 */
class Database {

    /**
     * mysql_connection
     * @var mysql_connect
     */
    private $connection;
    /**
     * The Last query which is used
     * @var string
     */
    public $lastquery;
    /**
     * Database user name
     * @var string
     */
    private $dbuser;
    /**
     * Database Password
     * @var string
     */
    private $dbpass;
    /**
     * Database sever name like localhost
     * @var string
     */
    private $dbserver;
    /**
     * Database name
     * @var database name
     */
    private $dbname;

    /**
     * Loads the Database information for opening a connection
     * @param string $dbuser
     * @param string $dbpass
     * @param string $dbname
     * @param string $dbserver
     */
    function __construct($dbuser, $dbpass, $dbname, $dbserver='localhost') {

        $this->dbuser = $dbuser;
        $this->dbpass = $dbpass;
        $this->dbserver = $dbserver;
        $this->dbname = $dbname;
    }

    /**
     * Creates a Database Connection
     */
    public function open_connection() {
        $this->connection = mysql_connect($this->dbserver, $this->dbuser, $this->dbpass);
        if (!$this->connection) {
            die("database connection failed :" . mysql_error());
        } else {
            $db = mysql_select_db($this->dbname, $this->connection);
            if (!$db) {
                die("Database cannot be selected :" . mysql_error());
            }
        }
    }

    /**
     * Closes The connection
     */
    public function close_connection() {
        if (isset($this->connection)) {
            mysql_close($this->connection);
            unset($this->connection);
        }
    }

    /**
     * Executes the Query
     * @param string $sql
     * @return array
     */
    public function query($sql) {
        if (!isset($this->connection)) {
            $this->open_connection();
        }
        $this->lastquery = $sql;
        $result = mysql_query($sql, $this->connection);

        $this->confirm($result);
        return $result;
    }

    /**
     * Checks whether the query failed or not..
     * @param bool $result_set
     */
    private function confirm($result_set) {
        if (!$result_set) {

            die("Query failed : " . mysql_error() . " " . $this->lastquery);
        }
    }

    /**
     * mysql_fetch_array();
     * @param resultset $result
     * @return array
     */
    public function fetch_array($result) {
        return mysql_fetch_array($result);
    }

    /**
     * returns no of the rows
     * @param resultset $result
     * @return int
     */
    public function num_rows($result) {

        return mysql_num_rows($result);
    }

    /**
     * returns number of affected rows
     * @return int
     */
    public function affected_rows() {
        return mysql_affected_rows();
    }

    /**
     * returns last insertion id
     * @return int
     */
    public function insert_id() {
        return mysql_insert_id();
    }

    /**
     * cleans the values, sanitizes the data
     * @param string $value
     * @return string
     */
    public function escape_values($value) {
        $value = addslashes($value);
        return $value;
    }

}

$database = new Database(
                $config['dbuser'],
                $config['dbpass'],
                $config['dbname'],
                $config['dbserver']
);
$db = & $database;
