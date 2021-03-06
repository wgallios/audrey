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
    public function getAlbums($id = null)
    {
        if (!empty($id))
        {
            $id = intval($id);

            if (empty($id)) throw new Exception("ID is empty!");

            $sqlAdd = " AND id = '{$id}' ";
        }

        $sql = "SELECT * FROM photoAlbums WHERE `deleted` = 0 {$sqlAdd} ORDER BY albumName";

        $query = $this->db->query($sql);

        $results = $query->result();

        // returns first row only if id is passed
        if (!empty($id)) return $results[0];

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

    /**
     * TODO: short description.
     *
     * @param mixed $folder 
     *
     * @return TODO
     */
    public function getFolderContent ($folder = null)
    {
        //$folder = (empty($folder)) ? ' IS NULL' : ' = ' . intval($folder);


        if (empty($folder))
        {

            $sql = "SELECT id, albumName AS `name`, 1 AS `type`
                FROM photoAlbums
                WHERE `deleted` = 0
                ORDER BY name";

            $query = $this->db->query($sql);

            $results = $query->result();

            // only need to get thumbnails if on root
            // albums will already have thumbnails associated with them in the DB
            $at = $this->getAlbumThumbs();

            if (!empty($at))
            {
                // unions uploaded photo thumbnails
                foreach ($at as $k => $img)
                {
                    $results[] = (object) array(
                        'id' => ($k + 1),
                        'name' => $img,
                        'type' => 2
                    );
                }
            }
        }
        else
        {
            $pics = $this->getAlbumPhotos($folder);

            if (!empty($pics))
            {
                $results = array();

                foreach ($pics as $r)
                {
                    $results[] = (object) array(
                        'id' => $r->id,
                        'name' => $r->file,
                        'type' => 2
                    );

                }
            }
        }

        return $results;
    }

    /**
     * TODO: short description.
     *
     * @param mixed $file 
     *
     * @return TODO
     */
    public function setPorfilePicture ($file)
    {

        $file = $this->db->escape_str($file);

        if (empty($file)) throw new Exception("file is empty!");

        $sql = "UPDATE settings SET profilePicture = '{$file}'";

        $this->db->query($sql);

        return true;
    }
}
