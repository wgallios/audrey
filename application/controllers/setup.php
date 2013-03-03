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


        if ($_POST)
        {
            try
            {
                $return['status'] = 'ALERT';

                // will first create upload diretory
                $create = $this->functions->createUploadFolder();

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
                        'db_debug' => true
                    );

                if ($this->ci->dbConnectTest = $this->load->database($config, true) === false)
                {
                    throw new exception("Unable to connect to database during setup process! (pre-database creation)!");
                }

                // attempts to create the database
                $createDB = $this->functions->createDatabase($_POST['dbName']);

                // connection was successfull - must now create database
                $config['database'] = $_POST['dbName'];

                // print_r($config);

                // reloads connection with database selected
                if ($dbConnected = $this->load->database($config, true) === false)
                {
                    throw new exception("Unable to connect to database during setup process! (post-database creation)");
                }

                // will attempt to connect to database
                $this->load->model('setup_model', '', $config);

                // reloads config connected to new database
                // $this->load->model('setup_model', '', $config);

                // will now setup database
                $this->setup_model->setupDatabase($dbConnected);

                // all is checked and applied, setup was successful
                $return['status'] = 'SUCCESS';
                die(json_encode($return));
            }
            catch(Exception $e)
            {
                $return['status'] = 'ERROR';
                $return['msg'] = 'Setup Error: ' . $e->getMessage();
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
