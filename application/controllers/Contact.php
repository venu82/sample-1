<?php

/**
 * This class is related to all contact details the client has stored
 * @category   controllers
 * @package    ContactController
 *
 */
class ContactController extends Controller {

    /**
     * This refers to model contact
     * @var Model_Contact
     */
    public $model;

    /**
     * This refers to Core API Class, overrides the constructor class
     * @param Api $api
     */
    public function __construct($api) {
        parent::__construct($api);
        if (!$this->api->isLoggedIn()) {
            $this->api->redirect('index/home');
        }
        $this->model = $this->api->loadModel('Contact');
        $this->model->user_id = $this->api->getUserId();
    }

    /**
     * creates the contacts pagination and diverts to view
     * and diverts to view name 'contact'
     */
    public function home() {
        $perpage = 10;
        $page = $this->api->getParam('page', '1');
        $pagination = new Pagination($page, $perpage);
        $result = $this->model->apply($pagination);
        $this->api->loadView('contact', array(
            'rows' => $result,
            'pagination' => $pagination,
            'link' => $this->api->getApplicationUrl() . 'contact/home'
        ));
    }

    /**
     * This action used to edit the contact
     * uses $this->checkOwner
     * uses view 'contact-form'
     */
    public function edit() {
        $id = $this->api->getParam('id');

        if ($id) {
            $this->model->id = $id;
            $this->checkOwner();
        }
        $object = $this->model->find_by_id($id);

        $this->api->loadView('contact-form', array('row' => $object));
    }

    /**
     * This action used to view a single contact
     * uses $this->checkOwner
     * uses view 'contact-view'
     */
    public function view() {
        $id = $this->api->getParam('id');
        $this->model->id = $id;
        $this->checkOwner();
        $object = $this->model->find_by_id($id);
        $images_array = $object->getFlickrImages($this->api->apikey);
        $this->api->loadView('contact-view', array(
            'row' => $object,
            'images' => $images_array
        ));
    }

    /**
     * This is action is used to add a contact
     * uses view 'contact-form'
     */
    public function add() {
        $this->api->loadView('contact-form',
                array(
                    'row' => $this->model
        ));
    }

    /**
     * This action is used to save the contact
     * if success it redirects to contact/home
     * else loads the view 'contact-form'
     */
    public function save() {
        $this->model->reverseInstantiate($_REQUEST);
        $message = array();

        if ($this->model->firstname == '') {
            $message['firstname'] = "Firstname cannot be empty";
        }

        if ($this->model->lastname == '') {
            $message['lastname'] = "Lastname cannot be empty";
        }

        if (count($message) == 0) {
            if (!($this->model->save())) {
                $message['message'] = ' No changes are made to the form';
            } else {
                $message['url'] = $this->api->getApplicationUrl() . 'contact/view?id=' . $this->model->id;
                $message['message'] = 'Saved Successfully';
            }
        } else {
            $message['message'] = 'Please Correct The Below Form Details and Try Saving';
        }
        echo json_encode($message);
        return true;
    }

    /**
     * This action is used to delete the contact
     * after deleting redirects to contact/home
     */
    public function delete() {
        $page = $this->api->getParam('page', '1');
        $this->model->id = $_REQUEST['id'];
        $this->checkOwner();
        $message = 'Cannot Be Deleted';
        if ($this->model->delete()) {
            $message = 'Deleted Successfully';
        }
        $this->api->redirect('contact/home?message=' . $message . '&page=' . $page);
    }

    /**
     * Action checks whether for a given contact is actual owner or not
     */
    private function checkOwner() {
        if (!$this->model->isOwner()) {
            $this->api->redirect('contact/home?message=Cannot Be Accessed');
        }
    }

}
