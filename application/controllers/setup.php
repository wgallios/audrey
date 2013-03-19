<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TODO: short description.
 *
 * TODO: long description.
 *
 */
class Setup extends CI_Controller
{
    function Setup()
    {
        parent::__construct();

        $this->load->library('session');

        $this->load->library('functions');

    }

    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function index()
    {
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

        $this->load->model('setup_model', '', false);

        $header['headscript'] .= "<script type='text/javascript' src='/min/?f=public/js/setup.js{$this->config->item('min_debug')}&amp;{$this->config->item('min_version')}'></script>\n";
        $header['onload'] = "setup.indexInit();";

        $this->load->view('templates/header_setup', $header);
        $this->load->view('setup/index');
        $this->load->view('templates/footer');
    }

    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function checkserver()
    {
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

        $this->load->model('setup_model', '', false);

        if ($_POST)
        {
            try
            {
                $return['status'] = 'ALERT';

                // will first create upload diretory
                $create = $this->functions->createUploadFolder();

                // checks logs directory permissions
                $this->functions->checkLogsDirectoryPermissions();

                // checks permissions of config directory for creating database.local.php later
                $this->functions->checkConfigDirectoryPermissions();

                // working on testing on connecting w/o db name
                $config = array
                    (
                        'hostname' => $_POST['dbHost'],
                        'username' => $_POST['dbUser'],
                        'password' => $_POST['dbPassword'],
                        'database' => '',
                        'dbdriver' => 'mysqli',
                        'dbprefix' => '',
                        'pconnect' => false,
                        'db_debug' => false,
                    );

                if ($this->load->database($config, true) === false)
                {
                    throw new exception("Unable to connect to database during setup process! (pre-database creation)!");
                }

                // will attempt to connect to database

                // attempts to create the database
                $createDB = $this->setup_model->createDatabase($_POST['dbName'], $config);

                // connection was successfull - must now create database
                $config['database'] = $_POST['dbName'];

                // print_r($config);

                // reloads connection with database selected
                if ($this->load->database($config, true) === false)
                {
                    throw new exception("Unable to connect to database during setup process! (post-database creation)");
                }

                // will now setup database
                $this->setup_model->setupDatabase($config);

                // create database.local.php
                $this->setup_model->createLocalDBconfig($config);

                // inserts admin user
                $userid = $this->setup_model->insertAdminUser($_POST, $config);

                // inserts initial settings row
                $this->setup_model->insertInitSettings($_POST, $config);

                // clears all previous cookies and session data

                /*
                foreach($_COOKIE as $key => $value)
                {
                    setcookie($key, '', 0, '/');
                }

                session_start();
                session_unset();
                session_destroy();

                // sets login cookie
                setcookie('userid', $id, 0, '/');
                */

                $array = array('userid' => null, 'logged_in' => false);

                $this->session->unset_userdata($array);


                // login was valid
                // setcookie('userid', $credit->id, 0, '/');

                $array = array
                    (
                        'userid' => $id,
                        'logged_in' => true
                    );

                $this->session->set_userdata($array);


                // all is checked and applied, setup was successful
                $return['status'] = 'SUCCESS';
                die(json_encode($return));
            }
            catch(Exception $e)
            {
                $return['status'] = 'ERROR';
                $return['msg'] = 'Setup Error: ' . nl2br($e->getMessage());
                $return['errorNumber'] = 3;
                $this->functions->sendStackTrace($e, 3);
                die(json_encode($return));
            }
        }

        $return['status'] = 'ERROR';
        $return['msg'] = 'Get is not supported';
        $return['errorNumber'] = 2;
        die(json_encode($return));
    }
}
