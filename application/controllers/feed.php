<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feed extends CI_Controller
{
    function Feed()
    {
        parent::__construct();

        $this->load->library('functions');

        #$this->load->model('welcome_model', 'welcome', true);

    }

}
