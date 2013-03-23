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

    /**
     * TODO: short description.
     *
     * @param array $p
     *
     * @return INT - id of albumPhoto
     */
    public function albumAddPhoto ($p)
    {
        $p = $this->functions->recursiveClean($p);

        $sql = "INSERT INTO albumPhotos SET
            datestamp = NOW(),
            albumId = '{$p['albumId']}',
            file = '{$p['file']}'";

        $this->db->query($sql);

        return $this->db->insert_id();
    }

    /**
     * TODO: short description.
     *
     * @param mixed $id 
     *
     * @return TODO
     */
    public function getAlbumPhotos ($id)
    {
        $id = intval($id);

        if (empty($id)) throw new Exception("ID is empty!");

        $sql= "SELECT * FROM albumPhotos WHERE albumId = {$id}";

        $query = $this->db->query($sql);

        $results = $query->result();

        return $results;
    }

    /**
     * TODO: short description.
     *
     * @param mixed $albumId 
     * @param mixed $file    
     *
     * @return boolean - true if already in that album
     */
    public function checkPhotoPartOfAlbum ($albumId, $file)
    {
        $albumId = intval($albumId);

        $file = $this->db->escape_str($file);

        if (empty($albumId)) throw new Exception ("albumId is empty!");

        $sql = "SELECT COUNT(*) cnt FROM albumPhotos WHERE albumId = '{$albumId}' AND `file` = '{$file}'";

        $query = $this->db->query($sql);

        $results = $query->result();

        if ($results[0]->cnt > 0)
        {
            return true;
        }

        return false;
    }

    /**
     * TODO: short description.
     *
     * @param mixed $id 
     *
     * @return TODO
     */
    public function getAlbumPhoto ($id)
    {
        $id = intval($id);

        if (empty($id)) throw new Exception("ID is empty!");

        $sql= "SELECT * FROM albumPhotos WHERE id = '{$id}'";

        $query = $this->db->query($sql);

        $results = $query->result();

        return $results[0];
    }

    /**
     * TODO: short description.
     *
     * @param mixed $p 
     *
     * @return TODO
     */
    public function updateImageCaption ($p)
    {
        $p = $this->functions->recursiveClean($p);

        if (empty($p['id'])) throw new Exception("ID is empty!");

        $sql = "UPDATE albumPhotos SET caption = '{$p['caption']}' WHERE id = '{$p['id']}'";

        $this->db->query($sql);

        return true;
    }
}
