<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TODO: short description.
 *
 * TODO: long description.
 *
 */
class setup_model extends CI_Model
{

    /**
     * TODO: short description.
     *
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Executes each sql/*.sql file
     *
     * @return TODO
     */
    public function setupDatabase($config)
    {
        $db = $this->load->database($config, true);

        $path = $_SERVER['DOCUMENT_ROOT'] . 'sql' . DS;

        // if sql/ folder does not exist
        if (!is_dir($path)) throw new Exception("SQL folder ({$path}) does not exist! Therefore no database files! oh geez. This is bad =/");

        $dh = opendir($path);

        if ($dh === false) throw new Exception("Unable to open {$path} directory!");

        // goes through each SQL file to execute
        while (($file = readdir($dh)) !== false)
        {
            // for testing pathing
            //throw new Exception("filename: " . $path . $file);

            // skips files that are not .sql
            if (strtolower(substr($file, -3)) !== 'sql') continue;

            $handle = fopen($path . $file, "r");

            if ($handle === false) throw new Exception("Unable to open file! ({$path}{$file})");

            $sql = null;

            while (($buffer = fgets($handle)) !== false)
            {
                $sql .= $buffer;
            }

            if (!feof($handle)) throw new Exception("Unexpected fgets() fail! ({$path}{$file})");

            if (!fclose($handle)) throw new Exception("Unable to close file! ({$path}{$file})");

            // may need to update later if stored procecures, triggers, events etc are created during setup process.
            // $functionPos = strpos(strtoupper($sql), 'DELIMITER');
            $functionPos = strpos(strtoupper($sql), 'CREATE FUNCTION');

            if ($functionPos === false) // is not a create function sql file
            {
                // explodes each file's to execute each statement 1 at a time
                $sqlArray = explode(";", $sql);

                if (!empty($sqlArray))
                {
                    foreach($sqlArray as $s)
                    {
                        $s = trim($s);

                        if (!empty($s)) $db->query($s);
                    }
                }
            }
            else // is a create function sql file, will execute entire string
            {
                // $db->query($sql);
                $db->conn_id->multi_query($sql);
            }
        }

        @closedir($dh);

        $db->close();

    return true;
    }

    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function createDatabase($databaseName, $config)
    {

        $db = $this->load->database($config, true);

        //$databaseName = $this->db->escape_str($databaseName);

        $sql = "CREATE DATABASE IF NOT EXISTS {$databaseName};";

        $db->query($sql);

        $db->close(); // close connection

    return true;
    }

    /**
     * Inserts main admin user
     *
     * @param array $p - $_POST array
     * @param array $config - database config settings
     *
     * @return INT - userid
     */
    public function insertAdminUser($p, $config)
    {
        $db = $this->load->database($config, true);

        // escape strings
        $p['username'] = $db->escape_str($p['username']);
        $p['password'] = $db->escape_str($p['password']);
        $p['firstName'] = $db->escape_str($p['firstName']);
        $p['lastName'] = $db->escape_str($p['lastName']);
        $p['email'] = $db->escape_str($p['email']);

        $sql = "INSERT INTO users SET
            datestamp = NOW(),
            username = '{$p['username']}',
            passwd = SHA1('{$p['password']}'),
            firstName = '{$p['firstName']}',
            lastName = '{$p['lastName']}',
            email = '{$p['email']}',
            status = 1,
            permissions = 1";

        $db->query($sql);

        $id = $db->insert_id();

        $db->close();

    return $id;
    }

    /**
     * creates the database.local.php file
     *
     * @param array $config - db connection array
     *
     * @return boolean
     */
    public function createLocalDBconfig($config)
    {
        $file = $_SERVER['DOCUMENT_ROOT'] . 'application' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'database.local.php';

        // creates file
        $touch = touch($file);

        if ($touch === false) throw new Exception("Unable to create database config file! ({$file})");

        $handle = fopen($file, 'w');

        if ($handle === false) throw new Exception("Unable to open database config file to write to it! ({$file})");

        $contents = '<?php' . PHP_EOL .
            '$db[\'default\'][\'hostname\'] = \'' . $config['hostname']  . '\';' . PHP_EOL .
            '$db[\'default\'][\'username\'] = \'' . $config['username']  . '\';' . PHP_EOL .
            '$db[\'default\'][\'password\'] = \'' . $config['password']  . '\';' . PHP_EOL .
            '$db[\'default\'][\'database\'] = \'' . $config['database']  . '\';';

        $write = fwrite($handle, $contents);

        if ($write === false) throw new Exception("Unable to write to database config file! ({$file})");

        @fclose($handle);

    return true;
    }

    /**
     * Inserts inital settings row
     *
     * @param array $p - $_POST array
     *
     * @return boolean
     */
    public function insertInitSettings($p, $config)
    {
        $db = $this->load->database($config, true);

        $versions = $this->config->item('versions');

        $majorVersion = $versions[count($versions) - 1][0];
        $minorVersion = $versions[count($versions) - 1][1];

        // escape strings
        $p['firstName'] = $db->escape_str($p['firstName']);
        $p['lastName'] = $db->escape_str($p['lastName']);
        $p['siteTitle'] = $db->escape_str($p['siteTitle']);

        // first clears any previous settings just in case
        $sql = "DELETE FROM settings";

        $db->query($sql);

        // now inserts settings row
        $sql = "INSERT INTO settings SET
            siteTitle = '{$p['siteTitle']}',
            firstName = '{$p['firstName']}',
            lastName = '{$p['lastName']}',
            majorVersion = '{$majorVersion}',
            minorVersion = '{$minorVersion}'";

        $db->query($sql);

        $db->close();

    return true;
    }
}
