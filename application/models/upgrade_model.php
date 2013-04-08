<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TODO: short description.
 *
 * TODO: long description.
 *
 */
class upgrade_model extends CI_Model
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
     * TODO: short description.
     *
     * @return TODO
     */
    public function performDBUpgrade()
    {

        $path = $_SERVER['DOCUMENT_ROOT'] . 'sql' . DS. 'updates' . DS;

        // if sql/updates folder does not exist - no updates to apply
        if (!is_dir($path)) return true;

        $dh = opendir($path);

        if ($dh === false) throw new Exception("Unable to open {$path} directory!");

        // goes through each SQL file to execute
        while (($file = readdir($dh)) !== false)
        {
            // skips files that are not .sql
            if (strtolower(substr($file, -3)) !== 'sql') continue;

            // gets database files that were already loaded
            $loadedFiles = $this->getLoadedUpgradeFiles();

            if (!empty($loadedFiles))
            {
                
            }


            $handle = fopen($path . $file, "r");

            if ($handle === false) throw new Exception("Unable to open file! ({$path}{$file})");

            $sql = null;

            while (($buffer = fgets($handle)) !== false)
            {
                $sql .= $buffer;
            }

            if (!feof($handle)) throw new Exception("Unexpected fgets() fail! ({$path}{$file})");

            if (!fclose($handle)) throw new Exception("Unable to close file! ({$path}{$file})");

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
                $db->conn_id->multi_query($sql);
            }

        }

    return true;
    }

    /**
     * TODO: short description.
     *
     * @return TODO
     */
    private function getLoadedUpgradeFiles ()
    {
        $sql= "SELECT filename FROM dbUpgradeFiles";

        $query = $this->db->query($sql);

        $results = $query->result();

        return $results;
    }

    /**
     * TODO: short description.
     *
     * @return TODO
     */
    private function insertLoadedDBFile()
    {

    }
}
