<?php
error_reporting(E_ALL);
/**
 * sets the base path of the application
 */
define('BASE_PATH',dirname(realpath(__FILE__)));
/**
 * sets the application path
 */
define('APP_PATH',BASE_PATH.'/application');

require_once(APP_PATH.'/bootstrap.php');
