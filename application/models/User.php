<?php

/**
 * Acts as bridge between table user and the application
 * @category models
 * @package User
 */
class User extends DatabaseModel {

    /**
     *
     * @var int
     */
    public $id;
    /**
     *
     * @var string
     */
    public $username;
    /**
     *
     * @var string
     */
    public $password;
    /**
     *
     * @var string
     */
    public $table_name = "user";
    /**
     *
     * @var array
     */
    public $db_fields = array("id", "username", "password");

    /**
     * checks the user credentials
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function login($username, $password) {
        $object_array = $this->find_by_sql("select * from " . $this->table_name . " where username='" . $username . "' and password='" . md5($password) . "'");
        if ($object_array && count($object_array) == 1) {
            return $object_array[0];
        }
        return false;
    }

}

