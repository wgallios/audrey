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
            if(!isset($_COOKIE['userid']))
            {
                header("Location: /home/login?site-error=" . urlencode("You are not logged in") . "&ref=" . uri_string());
                exit;
            }
        }
    }

    /**
     * Gets a code group
     *
     * @param int $group 
     * @param String $orderBy
     *
     * @return array->object
     */
    public function getCodes($group, $orderBy = null)
    {
        $ci =& get_instance();

        $group = intval($group);

        if (empty($group)) throw new Exception("Group is empty!");

        if (!empty($orderBy))
        {
            $orderBy = $ci->db->escape_str($orderBy);

            $sqlOrderBy = "ORDER BY " . $orderBy;
        }
        else
        {
            $sqlOrderBy = "ORDER BY display ASC";
        }

        $sql = "SELECT * FROM codes WHERE `group` = {$group} AND `code` <> 0 " . $sqlOrderBy;

        $query = $ci->db->query($sql);

        $results = $query->result();

    return $results;
    }
}
