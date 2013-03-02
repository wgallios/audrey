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
     * TODO: short description.
     *
     * @return TODO
     */
    public function createDatabase($databaseName)
    {
        //$databaseName = $this->db->escape_str($databaseName);

        $sql = "CREATE DATABASE IF NOT EXISTS {$databaseName};";

        $this->db->query($sql);

    return true;
    }

    /**
     * Executes each sql/*.sql file
     *
     * @return TODO
     */
    public function setupDatabse()
    {

        

    }
}
