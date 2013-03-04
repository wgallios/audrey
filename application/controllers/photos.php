<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photos extends CI_Controller
{
    function Photos()
    {
        parent::__construct();

        $this->load->library('functions');

        $this->functions->checkLoggedIn();

        $this->load->model('photos_model', 'photos', true);

    }

    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function index()
    {
        $header['nav'] = 'photos';

        $this->load->view('templates/header', $header);
        $this->load->view('photos/index', $body);
        $this->load->view('templates/footer');
    }

}
