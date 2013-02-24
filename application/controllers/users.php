<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller
{
    function Users()
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

        $header['headscript'] = "<script type='text/javascript' src='/min/?f=public/js/users.js{$this->config->item('min_debug')}&amp;{$this->config->item('min_version')}'></script>\n";
        $header['onload'] = "users.indexInit();";
        $header['nav'] = 'users';

        try
        {
            $body['users'] = $this->users->getUsers();
        }
        catch(Exception $e)
        {

        }

        $this->load->view('templates/header', $header);
        $this->load->view('users/index', $body);
        $this->load->view('templates/footer');
    }

    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function create()
    {
        $header['headscript'] = "<script type='text/javascript' src='/min/?f=public/js/users.js{$this->config->item('min_debug')}&amp;{$this->config->item('min_version')}'></script>\n";

        $header['onload'] = "users.createInit();";
        $header['nav'] = 'users';

        $this->load->view('templates/header', $header);
        $this->load->view('users/create', $body);
        $this->load->view('templates/footer');
    }

    /**
     * TODO: short description.
     *
     * @param mixed $id 
     *
     * @return TODO
     */
    public function edit($id)
    {
        $header['headscript'] = "<script type='text/javascript' src='/min/?f=public/js/users.js{$this->config->item('min_debug')}&amp;{$this->config->item('min_version')}'></script>\n";

        $header['onload'] = "users.editInit();";
        $header['nav'] = 'users';
        $body['id'] = $id;

        try
        {
            $body['info'] = $this->users->getUsers($id);
            $body['permissions'] = $this->users->getPermissionsList($_COOKIE['userid']);
        }
        catch(Exception $e)
        {
            header("Location: /users?site-error=" . urlencode("User ID was not specified!"));
            exit;
        }


        $this->load->view('templates/header', $header);
        $this->load->view('users/edit', $body);
        $this->load->view('templates/footer');
    }
}
