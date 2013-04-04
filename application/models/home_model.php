<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TODO: short description.
 *
 * TODO: long description.
 *
 */
class home_model extends CI_Model
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
     * @param String $username
     * @param String $password
     *
     * @return object
     */
    public function checkLogin($username, $password)
    {
        $username = $this->db->escape_str($username);
        $password = $this->db->escape_str($password);

        $sql = "SELECT * FROM users WHERE username  = '{$username}' AND passwd = SHA1('{$password}') AND `status` = 1";

        $query = $this->db->query($sql);

        $results = $query->result();

    return $results[0];
    }
}
