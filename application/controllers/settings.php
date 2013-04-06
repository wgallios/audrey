<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller
{
    function Settings()
    {
        parent::__construct();

        $this->load->library('functions');

        $this->functions->checkLoggedIn();

        $this->load->model('settings_model', 'settings', true);

    }

    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function index ()
    {

        $header['nav'] = 'settings';

        $this->load->view('templates/header', $header);
        $this->load->view('settings/index', $body);
        $this->load->view('templates/footer');
    }

}
