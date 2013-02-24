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
        $header['nav'] = 'home';
        $this->load->view('templates/header', $header);
        $this->load->view('home/index', $body);
        $this->load->view('templates/footer');
    }

    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function login()
    {
        $header['headscript'] = "<script type='text/javascript' src='/min/?f=public/js/home.js{$this->config->item('min_debug')}&amp;{$this->config->item('min_version')}'></script>\n";

        $header['onload'] = "home.loginInit();";

        if ($_POST)
        {
            try
            {
                $credit = $this->home->checkLogin($_POST['username'], $_POST['password']);

                if (!empty($credit))
                {
                    // clears previous cookies
                    foreach ($_COOKIE as $key => $value)
                    {
                        setcookie($key, '', 0, '/');
                    }

                    // login was valid
                    setcookie('userid', $credit->id, 0, '/');

                    // user tried accessing a page while not logged in - takes them back to that page instead of landing
                    if (!empty($_POST['ref']))
                    {
                        header("Location: /" . $_POST['ref']);
                        exit;
                    }

                    header("Location: /home");
                    exit;
                }
                else
                {
                    // invalid login attempt
                    header("Location: /home/login?site-error=" . urlencode("Invalid username or password"));
                    exit;
                }
            }
            catch(Exception $e)
            {

            }

        }

        $this->load->view('templates/header_login', $header);
        $this->load->view('home/login');
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
