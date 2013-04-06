<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TODO: short description.
 *
 * TODO: long description.
 *
 */
class feed_model extends CI_Model
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
    public function getPosts ($domain)
    {
        $domain = $this->db->escape_str($domain);

        if (empty($domain)) throw new Exception('Domain is empty!');

        $sql= "SELECT * FROM pagePosts WHERE domain = '{$domain}'";

        $query = $this->db->query($sql);

        $results = $query->result();

        return $results;
    }

}
