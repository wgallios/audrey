<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Functions
{

    /**
     * TODO: description.
     *
     * @var mixed
     */
    public $settings;

    public function __construct()
    {
        $this->settings = null;

        if (class_exists('CI_DB'))
        {
            if ($this->settings !== null) $this->settings = $this->getSettings();
        }
    }

    /**
     * Main function to check if DB setup is necessary
     */
    public function checkNeedSetup()
    {
        // checks if database.local.php exists
        $dbLocal = $_SERVER['DOCUMENT_ROOT'] . 'application' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'database.local.php';

        if (!file_exists($dbLocal))
        {
            return true;
        }

        return false;
    }

    /**
     * Checks if user is logged into backend
     *
     * @return boolean TRUE if logged in
     */
    public function checkLoggedIn()
    {
        // starts session if not already started

        $ci =& get_instance();

        $ci->load->helper('url');

        $ci->load->library('session');

        $pattern = '/^home\/login/';

        $login = preg_match($pattern, uri_string());

        if ($login == 0)
        {
            //if(!isset($_COOKIE['userid']))
            if($ci->session->userdata('logged_in') === true)
            {
                // do nothing
            }
            else
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
        $s = str_ireplace("<?php" , '', $s);
        $s = str_ireplace("<?" , '', $s);
        $s = str_ireplace("?>" , '', $s);
        $s = str_ireplace("<script" , '', $s);
        $s = str_ireplace("</script>" , '', $s);
        $s = str_ireplace("type='application/javascript'" , '', $s);
        $s = str_ireplace("type=\"application/javascript\"" , '', $s);
        $s = str_ireplace("type='text/javascript'" , '', $s);
        $s = str_ireplace("type=\"text/javascript\"" , '', $s);


    return $s;
    }


    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function createUploadFolder()
    {
        $ci =& get_instance();

        $publicPath = $_SERVER['DOCUMENT_ROOT'] . 'public';
        $path = $publicPath . DIRECTORY_SEPARATOR . 'uploads';


        // upload directory already exists - no need to create
        if (!is_dir($path))
        {
            // attempts to create upload directory
            if (!mkdir($path, 0777, true))
            {

                $solution = "<div class='row-fluid'>" .
                    "<hr>" .
                    //"<div class='span12 well'>" .
                    "<h5>Try the following solution</h5>" . 
                    "<p><code>sudo mkdir $path</code></p>" .
                    "<p><code>sudo chmod -R 777 $path</code></p>" .
                    //"</div>" .
                    "</div>";

                throw new Exception("Unable to create uploads directory ({$path})!" . $solution);
                return false;
            }

            return true;
        }

        // checks permissions just incase
        if (is_dir($path))
        {
            $perm = $ci->functions->filePermissions($path);

            if ($perm !== 'drwxrwxrwx')
            {
                $solution = "<div class='row-fluid'>" .
                    "<hr>" .
                    //"<div class='span12 well'>" .
                    "<h5>Try the following solution</h5>" . 
                    "<p><code>sudo chmod -R 777 $path</code></p>" .
                    //"</div>" .
                    "</div>";

                throw new Exception("Upload directory does not have the proper permissions ({$path})!" . $solution);
                return false;
            }
        }

    return true;
    }

    /**
     * Checks permissions for the logs directory
     *
     * @return boolean
     */
    public function checkLogsDirectoryPermissions()
    {
        $ci =& get_instance();

        $path = $_SERVER['DOCUMENT_ROOT'] . 'logs';

        // checks permissions just incase
        if (is_dir($path))
        {
            $perm = $ci->functions->filePermissions($path);

            if ($perm !== 'drwxrwxrwx')
            {
                $solution = "<div class='row-fluid'>" .
                    "<hr>" .
                    //"<div class='span12 well'>" .
                    "<h5>Try the following solution</h5>" . 
                    "<p><code>sudo chmod -R 777 $path</code></p>" .
                    //"</div>" .
                    "</div>";

                throw new Exception("logs directory does not have the proper permissions ({$path})!" . $solution);
                return false;
            }
        }

    return true;
    }

    /**
     * Checks permissions for the config/ directory
     *
     * @return boolean
     */
    public function checkConfigDirectoryPermissions()
    {
        $ci =& get_instance();

        $path = $_SERVER['DOCUMENT_ROOT'] . 'application' . DIRECTORY_SEPARATOR . 'config';

        // checks permissions just incase
        if (is_dir($path))
        {
            $perm = $ci->functions->filePermissions($path);

            if ($perm !== 'drwxrwxrwx')
            {
                $solution = "<div class='row-fluid'>" .
                    "<hr>" .
                    //"<div class='span12 well'>" .
                    "<h5>Try the following solution</h5>" . 
                    "<p><code>sudo chmod -R 777 $path</code></p>" .
                    //"</div>" .
                    "</div>";

                throw new Exception("config directory does not have the proper permissions ({$path})!" . $solution);
                return false;
            }
        }

    return true;
    }

    /**
     * Saves stack trace error in error log
     */
    public function sendStackTrace($e, $errorNum = 0)
    {
        $ci =& get_instance();

        $ci->load->library('session');

        $body = "Stack Trace Error:\n\n";
        $body .= "URL: {$_SERVER["SERVER_NAME"]}{$_SERVER["REQUEST_URI"]}\n";
        $body .= "Referer: {$_SERVER['HTTP_REFERER']}\n";

        if (!empty($errorNum))$body .= "Error Number: {$errorNum}\n\n";

        $body .= "User ID: {$ci->session->userdata('userid')}\n\n";
        $body .= "Message: " . $e->getMessage() . "\n\n";
        $body .= $e;

        error_log($body);

    }
    /**
     * TODO: short description.
     *
     * @param mixed $path 
     *
     * @return TODO
     */
    public function filePermissions($path)
    {
        $perms = fileperms($path);

        if (($perms & 0xC000) == 0xC000) {
            // Socket
            $info = 's';
        } elseif (($perms & 0xA000) == 0xA000) {
            // Symbolic Link
            $info = 'l';
        } elseif (($perms & 0x8000) == 0x8000) {
            // Regular
            $info = '-';
        } elseif (($perms & 0x6000) == 0x6000) {
            // Block special
            $info = 'b';
        } elseif (($perms & 0x4000) == 0x4000) {
            // Directory
            $info = 'd';
        } elseif (($perms & 0x2000) == 0x2000) {
            // Character special
            $info = 'c';
        } elseif (($perms & 0x1000) == 0x1000) {
            // FIFO pipe
            $info = 'p';
        } else {
            // Unknown
            $info = 'u';
        }

        // Owner
        $info .= (($perms & 0x0100) ? 'r' : '-');
        $info .= (($perms & 0x0080) ? 'w' : '-');
        $info .= (($perms & 0x0040) ?
                    (($perms & 0x0800) ? 's' : 'x' ) :
                    (($perms & 0x0800) ? 'S' : '-'));

        // Group
        $info .= (($perms & 0x0020) ? 'r' : '-');
        $info .= (($perms & 0x0010) ? 'w' : '-');
        $info .= (($perms & 0x0008) ?
                    (($perms & 0x0400) ? 's' : 'x' ) :
                    (($perms & 0x0400) ? 'S' : '-'));

        // World
        $info .= (($perms & 0x0004) ? 'r' : '-');
        $info .= (($perms & 0x0002) ? 'w' : '-');
        $info .= (($perms & 0x0001) ?
                    (($perms & 0x0200) ? 't' : 'x' ) :
                    (($perms & 0x0200) ? 'T' : '-'));

    return $info;
    }

    /**
     * Gets first and last name from settings for the site name
     *
     * @return String - site name
     */
    public function getSiteName()
    {
        $ci =& get_instance();

        $sql = "SELECT CONCAT_WS(' ', firstName, lastName) as name FROM settings";

        $query = $ci->db->query($sql);

        $results = $query->result();

    return $results[0]->name;
    }

    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function getSiteTitle()
    {
        $ci =& get_instance();

        $ci->load->helper('url');

        $pattern = '/^setup/';

        $setup = preg_match($pattern, uri_string());

        // if they are on the setup page
        if ($setup >  0)
        {
            return "Audrey Social Network Platform";
        }


        $sql = "SELECT siteTitle FROM settings";

        $query = $ci->db->query($sql);

        $results = $query->result();

    return $results[0]->siteTitle;
    }

    /**
     * Gets sites settings
     *
     * @return object
     */
    public function getSettings()
    {
        $ci =& get_instance();

        $sql = "SELECT *
            , codeDisplay(2, relationshipStatus) rssDisplay
            , codeDisplay(4, gender) genderDisplay
            , FLOOR(DATEDIFF(NOW(), dob) / 365.25) as age
            FROM settings";

        $query = $ci->db->query($sql);

        $results = $query->result();

    return $results[0];
    }

    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function authKey ()
    {
        #$settings = $this->getSettings();

    return $this->settings->authKey;
    }

    /**
     * gets the extension of a given file, Example: some_image.test.JPG
     *
     * @param string $file - filename
     *
     * @return string. E.g.: jpg
     */
    public function getFileExt($file)
    {
        $ld = strrpos($file, '.');

        // gets file extension
        $ext = strtolower(substr($file, $ld + 1, (strlen($file) - $ld)));

    return $ext;
    }

    /**
     * Used for ajax JSON post returns
     *
     * @param mixed $status   
     * @param mixed $msg      
     * @param mixed $errorNum 
     *
     * @return TODO
     */
    public function jsonReturn ($status, $msg, $errorNum = 0)
    {
        $return['status'] = $status;
        $return['msg'] = $msg;
        if (!empty($errorNum)) $return['errorNumber'] = $errorNum;
        echo json_encode($return);
        exit;
    }

    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function renderJsUserid ()
    {
        $ci =& get_instance();

        $ci->load->library('session');

        if ($ci->session->userdata('logged_in') === true)
        {

        $userid = $ci->session->userdata('userid');

        echo <<< EOS
        <script type='text/javascript'>
            asnp.userid = $userid
        </script>
EOS;
        }
        else
        {
        echo <<< EOS
        <script type='text/javascript'>
            asnp.userid = undefined;
        </script>
EOS;
        }

    }
}
