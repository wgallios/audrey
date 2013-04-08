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

        $versions = $this->config->item('versions');

        // gets database files that were already loaded
        $loadedFiles = $this->getLoadedUpgradeFiles();

        if (!empty($versions))
        {
            foreach ($versions as $v)
            {
                $majV = $v[0];
                $minV = $v[1];

                $file = "{$majV}.{$minV}.sql";

                if (file_exists($path . $file))
                {
                    if (!empty($loadedFiles))
                    {
                        $loaded = false;

                        foreach ($loadedFiles as $r)
                        {

                            if ($r->filename == $file)
                            {
                                $loaded = true;
                            }
                        }

                        // if file has already been loaded - will skip it
                        if ($loaded == true) continue;
                    }

                    // file has not been loaded - will go ahead and lead it
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

                    // saves in db that upgrade file was processed
                    $this->insertLoadedDBFile($file);

                }
                else
                {
                    // no DB upgrade for this file
                    continue;
                }
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
     * @return int - row id
     */
    private function insertLoadedDBFile($filename)
    {
        $filename = $this->db->escape_str($filename);

        $userid = $this->session->userdata('userid');

        $userid = intval($userid);

        if (empty($filename)) throw new Exception('filename is empty!');
        if (empty($userid)) throw new Exception('userid is empty!');

        $sql = "INSERT INTO dbUpgradeFiles
            datestamp = NOW(),
            userid = '{$userid}',
            filename = '{$filename}'";

        $this->db->query($sql);

        return $this->db->insert_id();
    }
}
