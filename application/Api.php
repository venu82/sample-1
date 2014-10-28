<?php

/**
 * Basic file resposible for implementing MVC and has many core functions
 * @category core
 * @package Api
 */
class Api {

    /**
     *
     * @var string
     */
    public $database;
    /**
     * baseurl
     * @var string
     */
    public $url;
    /**
     * flickr api
     * @var string
     */
    public $apikey;

    /**
     * loads the config and loads the controller
     * @global array $config
     */
    public function __construct() {
        session_start();
        global $config;
        $this->loadConfig($config);
        $this->loadController();
    }

    /**
     * loads the controller
     */
    public function loadController() {
        $controller = 'index';
        $action = 'home';
        if (isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'] != '') {
            $list = explode('/', $_SERVER['PATH_INFO']);
            if (isset($list[1]) & $list[1] != "") {
                $controller = $list[1];
            }
            if (isset($list[2]) && $list[2] != "") {
                $action = $list[2];
            }
        }
        $controller = ucfirst($controller);
        $file_path = APP_PATH . '/controllers/' . $controller . '.php';
        if (!file_exists($file_path)) {
            $this->pageNotFound("Unable to find classpath: $controller");
        }
        require_once $file_path;
        $controller = $controller . 'Controller';

        if (!class_exists($controller)) {
            $this->pageNotFound("Unable to load class: $contoller");
        }

        $c = new $controller($this);
        if (!method_exists($c, $action)) {
            $this->pageNotFound("Unable to load action: $action");
        }

        $c->{$action}();
    }

    /**
     * loads the view
     * @param string $file_name
     * @param array $data
     */
    public function loadView($file_name, $data=null) {
        if (is_array($data)) {
            extract($data);
        }
        $file_path = APP_PATH . '/views/' . $file_name . '.php';
        if (!file_exists($file_path)) {
            $this->pageNotFound("Unable to find view: $file_name");
        }
        include $file_path;
    }

    /**
     * loads the model
     * @param string $model_name
     * @return object
     */
    public function loadModel($model_name) {
        $file_path = APP_PATH . '/models/' . $model_name . '.php';
        if (!file_exists($file_path)) {
            $this->pageNotFound("Unable to find Model: $modle_name");
        }
        require_once $file_path;
        $model = new $model_name;
        return $model;
    }

    /**
     * if controller or action or model or view are not found
     * @param string $message
     */
    public function pageNotFound($message) {
        echo $message;
        exit;
    }

    /**
     * gets the parameter
     * @param string $name
     * @param string $defaultValue
     * @return string|bool
     */
    public function getParam($name, $defaultValue=null) {
        if (isset($_REQUEST[$name]) && trim($_REQUEST[$name]) != '') {
            return $_REQUEST[$name];
        } else {
            if ($defaultValue)
                return $defaultValue;
        }
        return false;
    }

    /**
     * Loads the config
     * @param array $config
     */
    public function loadConfig($config) {
        if (is_array($config['load'])) {
            foreach ($config['load'] as $value) {
                require_once APP_PATH . '/library/' . $value . '.php';
            }
        }
        $this->url = $config['base_path'];
        $this->apikey = $config['flickrapi'];
    }

    /**
     * returns the base url of the application
     * @return string
     */
    public function getBaseUrl() {
        return $this->url;
    }

    /**
     * returns the application url
     * @return string
     */
    public function getApplicationUrl() {
        return $this->url.'index.php/' ;
    }

    /**
     * redirect to the page
     * @param string $url
     */
    public function redirect($url) {
        header('Location: ' . $this->getApplicationUrl() . $url);
        exit;
    }

    /**
     * checks whether user is logged in or not
     * @return bool
     */
    public function isLoggedIn() {
        if (isset($_SESSION['userid'])) {
            return true;
        }
        return false;
    }

    /**
     * returns the username
     * @return string|bool
     */
    public function getUserName() {
        if (isset($_SESSION['username'])) {
            return $_SESSION['username'];
        }
        return false;
    }

    /**
     * returns the UserId
     * @return int|bool
     */
    public function getUserId() {
        if (isset($_SESSION['userid'])) {
            return $_SESSION['userid'];
        }
        return false;
    }

    /**
     * creates the session
     * @param int $userid
     * @param string $username
     */
    public function createSession($userid, $username) {
        $_SESSION['userid'] = $userid;
        $_SESSION['username'] = $username;
    }

    /**
     * destroy the session
     */
    public function destroySession() {
        session_destroy();
    }
    

}

$api = new Api();

