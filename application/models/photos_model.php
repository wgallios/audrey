<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TODO: short description.
 *
 * TODO: long description.
 *
 */
class photos_model extends CI_Model
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
    public function getAlbums()
    {
        $sql = "SELECT * FROM photoAlbums ORDER BY albumName";

        $query = $this->db->query($sql);

        $results = $query->result();

    return $results;
    }

    /**
     * TODO: short description.
     *
     * @param mixed $albumName 
     *
     * @return INT - album ID
     */
    public function createAlbum($albumName)
    {
        $albumName = $this->db->escape_str($albumName);

        $sql = "INSERT INTO photoAlbums SET
            datestamp = NOW(),
            albumName = '{$albumName}',
            deleted = 0";

        $this->db->query($sql);

    return $this->db->insert_id();
    }
}
