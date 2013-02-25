<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TODO: short description.
 *
 * TODO: long description.
 *
 */
class edit_model extends CI_Model
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
     * @return object
     */
    public function getSettings()
    {
        $sql = "SELECT * FROM settings LIMIT 1";

        $query = $this->db->query($sql);

        $results = $query->result();

    return $results[0];
    }
}
