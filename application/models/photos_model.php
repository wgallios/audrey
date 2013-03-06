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
        $sql = "SELECT * FROM photoAlbums WHERE `deleted` = 0 ORDER BY albumName";

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

    /**
     * Gets list of all thumbnails
     *
     * @return array $images 
     */
    public function getAlbumThumbs()
    {
        $path = $this->config->item('thumbnail_path');

        $images = array();

        if (!is_dir($path)) throw new Exception("({$path}) is not a valid directory!");

        $handle = @opendir($path);

        if ($handle === false) throw new Exception("Unable to open path! ({$path})");

        while (($entry = readdir($handle)) !== false)
        {
            if ($entry == '.' || $entry == '..')
            {
                // do nothing
            }
            else
            {
                $images[] = $entry;
            }
        }

        @closedir($handle);

    return $images;
    }
}
