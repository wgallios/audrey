<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit extends CI_Controller
{
    function Edit()
    {
        parent::__construct();

        $this->load->library('functions');

        $this->functions->checkLoggedIn();

        $this->load->model('users_model', 'users', true);

    }

    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function index()
    {

        $header['nav'] = 'editinfo';

        $this->load->view('templates/header', $header);
        $this->load->view('edit/index', $body);
        $this->load->view('templates/footer');
    }

}
