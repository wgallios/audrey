<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller
{
    function Settings()
    {
        parent::__construct();

        $this->load->library('functions');

        $this->functions->checkLoggedIn();

        $this->load->model('settings_model', 'settings', true);

    }

    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function index ()
    {

        $header['headscript'] = "<script type='text/javascript' src='/min/?f=public/js/settings.js{$this->config->item('min_debug')}&amp;{$this->config->item('min_version')}'></script>\n";

        $header['nav'] = 'settings';

        $header['onload'] = "settings.indexInit();";

        try
        {
            $body['settings'] = $this->functions->getSettings();

            if (empty($body['settings']->domian)) $body['settings']->domain = $_SERVER["HTTP_HOST"];
        }
        catch(Exception $e)
        {
            $this->functions->sendStackTrace($e);
        }

        $this->load->view('templates/header', $header);
        $this->load->view('settings/index', $body);
        $this->load->view('templates/footer');
    }

    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function update ()
    {
        if ($_POST)
        {
            try
            {
                $this->settings->updateSettings($_POST);
                $this->functions->jsonReturn('SUCCESS', 'Settings have been updated!', 1);
            }
            catch(Exception $e)
            {
                $this->functions->sendStackTrace($e);
                $this->functions->jsonReturn('ERROR', $e->getMessage(), 1);
            }
        }

        $this->functions->jsonReturn('ERROR', 'GET is not supported', 2);
    }
}
