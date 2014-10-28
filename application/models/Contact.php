<?php

/**
 * Acts as bridge between table contact and the application
 * @category models
 * @package  Contact
 */
class Contact extends DatabaseModel {

    /**
     * primary key
     * @var int
     */
    public $id;
    /**
     *
     * @var string
     */
    public $firstname;
    /**
     *
     * @var string
     */
    public $lastname;
    /**
     *
     * @var string
     */
    public $city;
    /**
     *
     * @var string
     */
    public $state;
    /**
     *
     * @var string
     */
    public $zip;
    /**
     *
     * @var int
     */
    public $user_id;
    /**
     *
     * @var string 
     */
    public $interests;
    /**
     *
     * @var string
     */
    public $table_name = "contact";
    /**
     * database fields
     * @var array 
     */
    public $db_fields = array("id", "firstname", "lastname", "city", "state", "zip", "user_id", "interests");

    /**
     * returns whether user is the owner of the contact
     * @return bool
     */
    public function isOwner() {
        $object_array = $this->find_by_sql("select * from " . $this->table_name . " where id=" . $this->id . ' and user_id=' . $this->user_id);
        if (count($object_array) == 1) {
            return true;
        }
        return false;
    }

    /**
     * returns number of the contacts of the user has
     * @global Database $database
     * @return int
     */
    public function count_all_userid() {
        global $database;
        $sql = "select count(*) from " . $this->table_name . ' where user_id=' . $this->user_id;
        $result = $database->query($sql);

        $count = 0;
        while ($row = $database->fetch_array($result)) {
            $count = $row[0];
        }
        return $count;
    }

    /**
     * returns all the contacts the user has
     * @param int $starting
     * @param int $ending
     * @return array
     */
    public function find_all_userid($starting, $ending) {

        return $this->find_by_sql("select * from " . $this->table_name . " where user_id=$this->user_id ORDER BY `id` DESC  limit $starting, $ending");
    }

    /**
     * gets the related filckr images
     * IMPLEMENTED APC CAHCE FOR STORING THE RESULTS FROM THE API
     * @param string $apikey
     * @return array
     */
    public function getFlickrImages($apikey="3210695772358f61bdf96d7744e39d28") {
        $images = array();
        if (!$this->interests || $this->interests == '') {
            return $images;
        }
        $interests = explode(",", $this->interests);
        $index = rand(0, count($interests) - 1);
        $interest = $interests[$index];

       // if ($images = $this->getCacheVariable($interest)) {
         //   return $images;
        //}
        $f = new phpFlickr($apikey);
        $result = $f->photos_search(array("tags" => $interests[$index], "per_page" => 4));
        foreach ($result['photo'] as $photo) {
            $images[$photo['title']] = $f->buildPhotoURL($photo, 'thumbnail');
        }
        //$this->setCacheVariable($interest, $images, 3000);
        return $images;
    }

    /**
     * Used for storing the cache variables
     * @param string $name
     * @param mixed $value
     * @param int $time
     * @return boolean
     */
    public function setCacheVariable($name, $value, $time=3000) {
        $name = md5($name);
        return apc_store($name, $value, $time);
    }

    /**
     * used for getting the cache variables
     * @param string $name
     * @return mixed
     */
    public function getCacheVariable($name) {
        $name = md5($name);
        return apc_fetch($name);
    }

    /**
     * applies the pagination
     * @param Pagination $pagination
     * @return array
     */
    public function apply($pagination) {

        $pagination->total_count = $this->count_all_userid();
        $total_pages = $pagination->totalpages();
        $page = $pagination->current_page;
        if ($page > $total_pages) {
            if ($total_pages == 0) {
                $pagination->current_page = 1;
            } else {
                $pagination->current_page = $total_pages;
                $page = $total_pages;
            }
        }
        $starting = $pagination->offset();
        $ending = $pagination->per_page;
        $result = $this->find_all_userid($starting, $ending);
        return $result;
    }

}

