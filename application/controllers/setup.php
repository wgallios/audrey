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
                        'database' => $_POST['dbName']
                    );
                // 
                // $config = array
                //     (
                //         'hostname' => $_POST['hostname'],
                //         'username' => $_POST['dbUser'],
                //         'password' => $_POST['dbPassword']
                //     );

                // will attempt to connect to database
                $this->load->model('setup_model', 'setup', $config);

                // attempts to create the database
                $createDB = $this->setup->createDatabase($_POST['dbName']);

                // all is checked and applied, setup was successful
                $return['status'] = 'SUCESS';
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
