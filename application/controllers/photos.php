<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photos extends CI_Controller
{
    function Photos()
    {
        parent::__construct();

        $this->load->model('photos_model', 'photos', true);
        $this->load->library('functions');
        $this->load->library('images');
        $this->load->library('session');
        $this->load->library('settings');

        $this->functions->checkLoggedIn();


    }

    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function index($folder = null)
    {
        $header['nav'] = 'photos';

        $header['headscript'] = "<script type='text/javascript' src='/public/ckfinder2.3.1/ckfinder.js'></script>\n";

        $header['headscript'] .= "<script type='text/javascript' src='/min/?f=public/js/photos.js{$this->config->item('min_debug')}&amp;{$this->config->item('min_version')}'></script>\n";
        $header['headscript'] .= "<script type='text/javascript' src='/public/ckeditor4.0.2/ckeditor.js'></script>\n";

        $header['onload'] = "photos.indexInit();";

        $body['folder'] = $folder;

        try
        {
            if (!empty($folder)) $body['folderInfo'] = $this->photos->getAlbums($folder);

            $body['content'] = $this->photos->getFolderContent($folder);
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
                $this->functions->sendStackTrace($e, 1);
                $this->functions->jsonReturn('ERROR', $e->getMessage(), 1);
            }
        }

        $this->functions->jsonReturn('ERROR', 'GET is not supported', 2);
    }

    /**
     * TODO: short description.
     *
     * @param mixed $id 
     *
     * @return TODO
     */
    public function edit ($file)
    {
        $body['file'] = urldecode($file);

        try
        {
            $body['settings'] = $this->functions->getSettings();
        }
        catch(Exception $e)
        {
            $this->functions->sendStackTrace($e);
        }

        $this->load->view('photos/edit', $body);
    }

    /**
     * TODO: short description.
     *
     * @param mixed $id 
     *
     * @return TODO
     */
    public function editalbum($id)
    {

        $header['nav'] = 'photos';

        $header['headscript'] = "<script type='text/javascript' src='/min/?f=public/js/photos.js{$this->config->item('min_debug')}&amp;{$this->config->item('min_version')}'></script>\n";

        $header['headscript'] .= "<script type='text/javascript' src='/public/ckeditor4.0.2/ckeditor.js'></script>\n";

        $header['onload'] = "photos.editalbumInit()";

        if (empty($id))
        {
            header("Location: /photos?site-error=" . urlencode("ID was not specified!"));
            exit;
        }

        $body['id'] = $id;

        try
        {
            $body['images'] = $this->photos->getAlbumThumbs();
        }
        catch(Exception $e)
        {
            $this->functions->sendStackTrace($e);
        }


        $this->load->view('templates/header', $header);
        $this->load->view('photos/editalbum', $body);
        $this->load->view('templates/footer');

    }

    public function albumaddphoto ()
    {
        if ($_POST)
        {
            try
            {
                // first check if file is already apart of that album
                $check = $this->photos->checkPhotoPartOfAlbum($_POST['albumId'], $_POST['file']);

                if ($check === true)
                {
                    $return['status'] = 'ALERT';
                    $return['msg'] = "This photo is already apart of this album";
                    die(json_encode($return));
                }

                $id = $this->photos->albumAddPhoto($_POST);

                $return['status'] = 'SUCCESS';
                $return['id'] = $id;
                die(json_encode($return));
            }
            catch(Exception $e)
            {
                $this->functions->sendStackTrace($e, 1);
                $this->functions->jsonReturn('ERROR', $e->getMessage(), 1);
            }
        }


        $this->functions->jsonReturn('ERROR', 'GET is not supported', 2);
    }

    /**
     * TODO: short description.
     *
     * @param mixed $id 
     *
     * @return TODO
     */
    public function photoalbum ($id)
    {
        try
        {
            $body['photos'] = $this->photos->getAlbumPhotos($id);
        }
        catch(Exception $e)
        {
            $this->functions->sendStackTrace($e);
        }


        $this->load->view('photos/photoalbum', $body);
    }

    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function block ($img, $size = 50, $path = null)
    {
        try
        {
            $this->images->block($img, $size, $path);
        }
        catch(Exception $e)
        {
            $this->functions->sendStackTrace($e);
        }
    }

    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function editphoto ($id)
    {

        $body['id'] = $id;

        try
        {
            $body['info'] = $this->photos->getAlbumPhoto($id);
        }
        catch(Exception $e)
        {
            $this->functions->sendStackTrace($e);
        }

        $this->load->view('photos/editphoto', $body);

    }

    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function savePhotoEdit ()
    {
        if ($_POST)
        {
            try
            {
                // updates image caption
                $this->photos->updateImageCaption($_POST);

                $this->functions->jsonReturn('SUCCESS', 'Image has been updated!');
            }
            catch(Exception $e)
            {
                $this->functions->sendStackTrace($e);

                $this->functions->jsonReturn('ERROR', $e->getMessage(), 1);
            }
        }

    $this->functions->jsonReturn('ERROR', 'GET is not supported', 2);

    }

    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function setprofilepicture ()
    {

        if ($_POST)
        {
            try
            {
                $this->photos->setPorfilePicture($_POST['file']);

                $this->functions->jsonReturn('SUCCESS', 'Profile picture has been set!');
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
