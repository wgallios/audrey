<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Posts extends CI_Controller
{
    function Posts()
    {
        parent::__construct();

        $this->load->library('functions');
        $this->load->library('session');
        $this->load->model('posts_model', 'posts', true);
    }

    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function post()
    {

        if ($_POST)
        {
            try
            {
                $_POST['post'] = strip_tags($_POST['post']); // removes all HTML tags

                $id = $this->posts->insertPagePost($this->session->userdata('userid'), $_POST['post'], $_POST['domain']);

                $return['status'] = 'SUCCESS';
                $return['id'] = $id;
                die(json_encode($return));
            }
            catch(Exception $e)
            {
                $this->functions->sendStackTrace($e);

                $this->functions->jsonReturn('ERROR', $e->getMessage(), 1);
            }
        }

        $this->functions->jsonReturn('ERROR', 'GET is not supported', 2);
    }

    public function stream()
    {
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

        $body['top'] = $_GET['top'];
        $body['tail'] = $_GET['tail'];

        try
        {
            $body['posts'] = $this->posts->getStream($_GET['top'], $_GET['tail']);
        }
        catch(Exception $e)
        {
            $this->functions->sendStackTrace($e);
        }

        $this->load->view('posts/stream', $body);
    }
}
