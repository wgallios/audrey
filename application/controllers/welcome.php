<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    function Welcome()
    {
        parent::__construct();

        $this->load->library('functions');
        $this->load->library('session');

        if ($this->functions->checkNeedSetup() == true)
        {
            header("Location: /setup");
            exit;
        }

        $this->load->model('welcome_model', 'welcome', true);

    }

    public function index()
    {
        $header['headscript'] = "<script type='text/javascript' src='/min/?f=public/js/welcome.js{$this->config->item('min_debug')}&amp;{$this->config->item('min_version')}'></script>\n";
        
        $header['headscript'] .= "<script type='text/javascript' src='/public/js/jquery.autosize-min.js'></script>\n";

        $header['headscript'] .= "<script type='text/javascript' src='/min/?f=public/js/posts.js{$this->config->item('min_debug')}&amp;{$this->config->item('min_version')}'></script>\n";
    

        $header['onload'] = "welcome.indexInit();";

        try
        {
            $body['settings'] = $this->functions->getSettings();
        }
        catch(Exception $e)
        {
            $this->functions->sendStackTrace($e);
        }


        $this->load->view('templates/header', $header);
        $this->load->view('welcome/homepage', $body);
        $this->load->view('templates/footer');
    }

    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function profile()
    {

    }

    /**
     * for debugging
     *
     * @return TODO
     */
    public function phpinfo ()
    {
        phpinfo();
    }

    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function version()
    {
        $versions = $this->config->item('versions');

        echo $versions[count($versions) - 1][0] . '.' . $versions[count($versions) - 1][1];

    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
