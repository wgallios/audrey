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

        $this->load->model('setup_model', 'setup');

    }

    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function index()
    {
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

                

                // all is checked and applied, setup was successful
                $return['status'] = 'SUCESS';
                die(json_encode($return));
            }
            catch(Exception $e)
            {
                $return['status'] = 'ERROR';
                $return['msg'] = 'Get is not supported';
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
