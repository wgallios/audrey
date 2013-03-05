<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photos extends CI_Controller
{
    function Photos()
    {
        parent::__construct();

        $this->load->library('functions');

        $this->functions->checkLoggedIn();

        $this->load->model('photos_model', 'photos', true);

    }

    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function index()
    {
        $header['nav'] = 'photos';

        $header['headscript'] = "<script type='text/javascript' src='/public/ckfinder2.3.1/ckfinder.js'></script>\n";

        $header['headscript'] .= "<script type='text/javascript' src='/min/?f=public/js/photos.js{$this->config->item('min_debug')}&amp;{$this->config->item('min_version')}'></script>\n";

        $header['onload'] = "photos.indexInit();";

        try
        {
            $body['albums'] = $this->photos->getAlbums();
        }
        catch(Exception $e)
        {
            $this->functions->sendStackTrace($e);
        }

        $this->load->view('templates/header', $header);
        $this->load->view('photos/index', $body);
        $this->load->view('templates/footer');
    }

    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function albums()
    {

        try
        {
            $body['albums'] = $this->photos->getAlbums();
        }
        catch(Exception $e)
        {
            $this->functions->sendStackTrace($e);
        }

        $this->load->view('photos/albums', $body);
    }

    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function createalbum()
    {
        if ($_POST)
        {
            try
            {
                $id = $this->photos->createAlbum($_POST['albumName']);

                $return['status'] = 'SUCCESS';
                $return['id'] = $id;
                die(json_encode($return));
            }
            catch(Exception $e)
            {
                $return['status'] = 'ERROR';
                $return['msg'] = $e->getMessage();
                $return['errorNumber'] = 1;
                $this->functions->sendStackTrace($e, 1);
                die(json_encode($return));
            }
        }

        $return['status'] = 'ERROR';
        $return['msg'] = 'Get is not supported';
        $return['errorNumber'] = 2;
        die(json_encode($return));
    }
}
