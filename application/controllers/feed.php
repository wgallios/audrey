<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feed extends CI_Controller
{
    function Feed()
    {
        parent::__construct();

        $this->load->library('functions');

        $this->load->model('feed_model', 'feed', true);

    }


    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function posts ()
    {

        try
        {
            $settings = $this->functions->getSettings();

            $posts = $this->feed->getPosts($settings->domain);

            print_r(json_encode($posts));

        }
        catch(Exception $e)
        {
            $this->functions->sendStackTrace($e);
        }


        // $this->load->view('feed/posts', $body);
    }
}
