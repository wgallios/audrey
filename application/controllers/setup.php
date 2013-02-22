<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TODO: short description.
 *
 * TODO: long description.
 *
 */
class Setup extends CI_Controller
{
    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function index()
    {

        $this->load->view('templates/header_setup');
        $this->load->view('setup/index');
        $this->load->view('templates/footer');
    }
}
