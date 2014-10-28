<?php

/**
 * Basic Controller which is to be extended by every body
 * @category library
 * @package controller
 */
class Controller {

    /**
     * Core Api Class object
     * @var Api
     */
    public $api;

    /**
     *  Core Api Class Object
     * and assigns it to the class
     * @param Api $api
     */
    public function __construct($api) {
        $this->api = $api;
    }

}

