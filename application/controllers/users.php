<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller
{
    function Users()
    {
        parent::__construct();

        $this->load->model('users_model', 'users', true);
        $this->load->library('functions');
        $this->load->library('settings');
        $this->load->library('session');

        $this->functions->checkLoggedIn();

        $this->functions->checkDBUpgrades();

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
            $body['permissions'] = $this->users->getPermissionsList($id);
            $body['statuses'] = $this->functions->getCodes(1);
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

    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function checkusername()
    {
        if ($_POST)
        {
            try
            {
                $check = $this->users->checkUsernameInUse($_POST['username']);

                if ($check == true)
                {
                    $return['status'] = 'SUCCESS';
                    $return['msg'] = 'INUSE';
                    echo json_encode($return);
                    exit;
                }
            }
            catch(Exception $e)
            {
                $return['status'] = 'ERROR';
                $return['msg'] = $e->getMessage();
                $return['errorNumber'] = 1;
                echo json_encode($return);
                exit;
            }


            $return['status'] = 'SUCCESS';
            $return['msg'] = 'AVAILABLE';
            echo json_encode($return);
            exit;
        }

        $return['status'] = 'ERROR';
        $return['msg'] = 'Get is not supported';
        $return['errorNumber'] = 2;
        echo json_encode($return);
        exit;
    }

    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function createnew()
    {
        if ($_POST)
        {
            try
            {
                $userid = $this->users->createNew($_POST);

                $return['status'] = 'SUCCESS';
                $return['userid'] = $userid;
                echo json_encode($return);
                exit;
            }
            catch(Exception $e)
            {
                $return['status'] = 'ERROR';
                $return['msg'] = $e->getMessage();
                $return['errorNumber'] = 1;
                echo json_encode($return);
                exit;
            }
        }

        $return['status'] = 'ERROR';
        $return['msg'] = 'Get is not supported';
        $return['errorNumber'] = 2;
        echo json_encode($return);
        exit;
    }

    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function save()
    {
        if ($_POST)
        {
            try
            {
                // checks password
                if (!empty($_POST['currentPassword']))
                {
                    $check = $this->users->checkPassword($this->session->userdata('userid'), $_POST['currentPassword']);

                    // password check came back incorrect
                    if ($check === false)
                    {
                        $return['status'] = 'ALERT';
                        $return['msg'] = "Current password is incorrect!";
                        die(json_encode($return));
                    }

                    // updates password
                    $this->users->updatePassword($_POST['userid'], $_POST['newPassword']);
                }

                // checks if username has been changed
                if ($_POST['username'] !== $_POST['currentUsername'])
                {
                    // checks if username is available
                    $usernameCheck = $this->users->checkUsernameInUse($_POST['username']);

                    // username is in use
                    if ($usernameCheck === true)
                    {
                        $return['status'] = 'ALERT';
                        $return['msg'] = "The username {$_POST['username']} is already in use!";
                        die(json_encode($return));
                    }
                }

                $this->users->saveSettings($_POST);

                $return['status'] = 'SUCCESS';
                $return['msg'] = "User settings have been updated!";
                die(json_encode($return));
            }
            catch(Exception $e)
            {
                $return['status'] = 'ERROR';
                $return['msg'] = $e->getMessage();
                $return['errorNumber'] = 1;
                die(json_encode($return));
            }
        }

        $return['status'] = 'ERROR';
        $return['msg'] = 'Get is not supported';
        $return['errorNumber'] = 2;
        die(json_encode($return));
    }
}
