<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Functions
{
    /**
     * Main function to check if DB setup is necessary
     */
    public function checkNeedSetup()
    {


        return false;
    }

    /**
     * Checks if user is logged into backend
     *
     * @return boolean TRUE if logged in
     */
    public function checkLoggedIn()
    {
        $ci =& get_instance();

        $ci->load->helper('url');

        $pattern = '/^home\/login/';

        $login = preg_match($pattern, uri_string());

        if ($login == 0)
        {
            if(!isset($_COOKIE['UserID']))
            {
                header("Location: /home/login?site-error=" . urlencode("You are not logged in") . "&ref=" . uri_string());
                exit;
            }
        }
    }
}
