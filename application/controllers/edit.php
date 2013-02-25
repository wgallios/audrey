<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit extends CI_Controller
{
    function Edit()
    {
        parent::__construct();

        $this->load->library('functions');

        $this->functions->checkLoggedIn();

        $this->load->model('edit_model', 'edit', true);

    }

    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function index()
    {

        //$header['headscript'] .= "<script type='text/javascript' src='/min/?f=public/ckeditor4.0.1.1/ckeditor.js{$this->config->item('min_debug')}&amp;{$this->config->item('min_version')}'></script>\n";
        $header['headscript'] .= "<script type='text/javascript' src='/public/ckeditor4.0.1.1/ckeditor.js'></script>\n";

        $header['headscript'] .= "<script type='text/javascript' src='/min/?f=public/js/edit.js{$this->config->item('min_debug')}&amp;{$this->config->item('min_version')}'></script>\n";


        $header['onload'] = "edit.indexInit();";

        $header['nav'] = 'editinfo';


        try
        {
            $body['genders'] = $this->functions->getCodes(4);
            $body['weights'] = $this->functions->getCodes(3);
            $body['rss'] = $this->functions->getCodes(2); // relaltionship statuses

            $body['info'] = $this->edit->getSettings();
        }
        catch(Exception $e)
        {

        }

        $this->load->view('templates/header', $header);
        $this->load->view('edit/index', $body);
        $this->load->view('templates/footer');
    }

}
