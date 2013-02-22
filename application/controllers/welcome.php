<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    /*
    function Welcome()
    {
    }
    */
    public function index()
    {

        $this->load->view('templates/header');
        $this->load->view('welcome/homepage');
        $this->load->view('templates/footer');
    }

    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function profile()
    {

    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
