<?php
/**
 * loads the config details
 */
/**
 * database details
 */
$config['dbname']='address_book';
$config['dbuser']='root';
$config['dbpass']='test';
$config['dbserver']='localhost';
/**
 * filckr api key
 */
$config['flickrapi']="3210695772358f61bdf96d7744e39d28";
/**
 * loading files
 */
$config['load'][]='Controller';

$config['load'][]='DatabaseModel';
$config['load'][]='Pagination';
$config['load'][]='phpFlickr';
$config['base_path']='/samplemvc-code/';