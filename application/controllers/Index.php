<?php

/**
 * This class is related to all basic functionalities in the application
 * @category   controllers
 * @package    IndexController
 *
 */
class IndexController extends Controller {

    /**
     * This action check whether user is logged in or not..
     * if logged in redirects to Contacts Page
     * else it loads view 'login'
     */
    public function home() {
        if ($this->api->isLoggedIn()) {
            $this->api->redirect('contact/home');
        }
        $this->api->loadView('login');
    }

    /**
     * Allows the User to Login into the site
     */
    public function login() {
        $username = $this->api->getParam('username', '');
        $password = $this->api->getParam('password', '');
        $model = $this->api->loadModel('User');
        $result = $model->login($username, $password);
        $data = array();
        if (!$result) {
            $data ['message'] = "Invalid Username or Password";
        } else {
            $this->api->createSession($result->id, $result->username);
            $data['message'] = "Loged Successfully";
            $data['url'] = $this->api->getApplicationUrl() . 'contact/home';
        }
        echo json_encode($data);
        return true;
    }

    /**
     * Action used by the user to logout of the application
     */
    public function logout() {
        $this->api->destroySession();
        $this->api->redirect('index/home');
    }

}
