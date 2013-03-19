<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller
{
    function Auth()
    {
        parent::__construct();

        $this->load->library('functions');

        $this->load->library('session');

        $this->functions->checkLoggedIn();

        $this->load->model('auth_model', 'auth', true);

    }

    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function index()
    {
        $this->load->model('users_model', 'users', true);

        $header['headscript'] .= "<script type='text/javascript' src='/min/?f=public/js/auth.js{$this->config->item('min_debug')}&amp;{$this->config->item('min_version')}'></script>\n";

        $header['onload'] = "auth.indexInit();";

        $header['nav'] = 'auth';

        try
        {
            $body['key'] = $this->auth->getCurrentKey();
            $body['userInfo'] = $this->users->getUsers($this->session->userdata('userid'));
        }
        catch(Exception $e)
        {

        }

        $this->load->view('templates/header', $header);
        $this->load->view('auth/index', $body);
        $this->load->view('templates/footer');
    }

    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function authsite()
    {
        $this->load->model('users_model', 'users', true);

        try
        {
            $userInfo = $this->users->getUsers($this->session->userdata('userid'));

            $auth = $this->auth->authSite($userInfo->username, $userInfo->email, $_SERVER['HTTP_HOST']);

            echo $auth;

            $d = json_decode($auth);

            if ($d->status == 'SUCCESS')
            {
                $this->auth->saveKey($d->key);
            }
        }
        catch(Exception $e)
        {

        }
    }

}
