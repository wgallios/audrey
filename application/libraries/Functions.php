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

    /*
     * cleans an entire array
     */
    public function recursiveClean($array)
    {
        $ci =& get_instance();

        if (!empty($array))
        {
            foreach ($array as $k => $v)
            {
                if(is_array($v))
                {
                    $array[$k] = $ci->functions->recursiveClean($v);
                }
                else
                {
                    $array[$k] = $ci->db->escape_str($v);
                }
            }
        }

        return $array;
    }

    /**
     * Removes certain programming tags like PHP, JS, and certain HTML
     *
     * @param String $s 
     *
     * @return String
     */
    public function removeCode($s)
    {
        $s = str_replace("<?php" , '', $s);
        $s = str_replace("<?PHP" , '', $s);
        $s = str_replace("<?Php" , '', $s);
        $s = str_replace("<?PHp" , '', $s);
        $s = str_replace("<?pHp" , '', $s);
        $s = str_replace("<?pHP" , '', $s);
        $s = str_replace("<?PhP" , '', $s);
        $s = str_replace("<?" , '', $s);
        $s = str_replace("?>" , '', $s);
        $s = str_replace("<script" , '', $s);
        $s = str_replace("</script>" , '', $s);
        $s = str_replace("type='application/javascript'" , '', $s);
        $s = str_replace("type=\"application/javascript\"" , '', $s);
        $s = str_replace("type='text/javascript'" , '', $s);
        $s = str_replace("type=\"text/javascript\"" , '', $s);


    return $s;
    }

    /**
     * Saves stack trace error in error log
     */
    public function sendStackTrace($e)
    {
        $body = "Stack Trace Error:\n\n";
        $body .= "URL: {$_SERVER["SERVER_NAME"]}{$_SERVER["REQUEST_URI"]}\n";
        $body .= "Referer: {$_SERVER['HTTP_REFERER']}\n";
        $body .= "User ID: {$_COOKIE['userid']}\n\n";
        $body .= "Message: " . $e->getMessage() . "\n\n";
        $body .= $e;

        error_log($body);

    }
}
