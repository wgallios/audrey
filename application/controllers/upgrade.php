<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TODO: short description.
 *
 * TODO: long description.
 *
 */
class Upgrade extends CI_Controller
{
    function Upgrade()
    {
        parent::__construct();

        $this->load->model('upgrade_model', 'upgrade', true);

        $this->load->library('session');
        $this->load->library('settings');
        $this->load->library('functions');

        $this->functions->checkLoggedIn();
    }

    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function index ()
    {
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

        $header['headscript'] .= "<script type='text/javascript' src='/min/?f=public/js/upgrade.js{$this->config->item('min_debug')}&amp;{$this->config->item('min_version')}'></script>\n";
        $header['onload'] = "upgrade.indexInit();";

        $this->load->view('templates/header', $header);
        $this->load->view('upgrade/index');
        $this->load->view('templates/footer');
    }

    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function process ()
    {
        try
        {
            $this->upgrade->performDBUpgrade();
        }
        catch(Exception $e)
        {
            $this->functions->sendStackTrace($e);
        }
    }
}
