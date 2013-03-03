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
    public function setupDatabase($dbConnection)
    {

        $path = $_SERVER['DOCUMENT_ROOT'] . 'sql' . DIRECTORY_SEPARATOR;

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

            if (!feof($handle)) throw new Exception("Unexecpted fgets() fail! ({$path}{$file})");

            if (!fclose($handle)) throw new Exception("Unable to close file! ({$path}{$file})");

            // $sql variable shoudl now have file contents and will now execute sql file
            $dbConnection->query($sql);

        }

        @closedir($dh);

    return true;
    }
}
