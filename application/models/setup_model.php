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
        $databaseName = $this->db->escape_str($databasename);

        $sql = "CREATE DATABASE IF NOT EXISTS {$databaseName};";

        $this->db->query($sql);

    return true;
    }
}
