<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller
{
    function Auth()
    {
        parent::__construct();

        $this->load->library('functions');

        $this->functions->checkLoggedIn();

        #$this->load->model('users_model', 'users', true);

    }

    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function index()
    {
        $this->load->model('users_model', 'users', true);

        $header['nav'] = 'auth';

        try
        {
            $body['userInfo'] = $this->users->getUsers($_COOKIE['userid']);
        }
        catch(Exception $e)
        {

        }

        $this->load->view('templates/header', $header);
        $this->load->view('auth/index', $body);
        $this->load->view('templates/footer');
    }

}
