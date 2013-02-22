<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{
    function Home()
    {
        parent::__construct();

        $this->load->library('functions');

        $this->functions->checkLoggedIn();

        $this->load->model('home_model', 'home', true);

    }


    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function index()
    {
        echo "index";
    }

    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function login()
    {

        if ($_POST)
        {
            try
            {
                $credit = $this->Welcome_model->check_login($_POST['username'], $_POST['password']);
            }
            catch(Exception $e)
            {

            }
        }

        $this->load->view('templates/header_login');
        $this->load->view('welcome/login');
        $this->load->view('templates/footer_login');
    }

    public function logout()
    {
        // page will not cache
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

        foreach($_COOKIE as $key => $value)
        {
            setcookie($key, '', 0, '/');
        }

        session_start();
        session_unset();
        session_destroy();

        header("Location: /");
        exit;
    }

}
