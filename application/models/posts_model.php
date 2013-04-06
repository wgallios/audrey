<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TODO: short description.
 *
 * TODO: long description.
 *
 */
class posts_model extends CI_Model
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
     * @param mixed $userid 
     * @param mixed $post   
     *
     * @return TODO
     */
    public function insertPagePost ($userid, $post, $domain = null)
    {
        $userid = intval($userid);

        //if (empty($userid)) throw new Exception("userid is empty!");
        $userid = (empty($userid)) ? 'NULL' : $userid;

        $post = $this->db->escape_str($post);

        $sql = "INSERT INTO pagePosts SET
            datestamp = NOW(),
            userid = {$userid},
            domain = '{$domain}',
            post = '{$post}'";

        $this->db->query($sql);

        return $this->db->insert_id();
    }

    /**
     * Loads post stream
     *
     * @return array->object
     */
    public function getStream($top = null, $tail = null, $userid = null, $id = null)
    {
        if (empty($EMPID)) $userid = $this->session->userdata('userid');

        $userid = intval($userid);

        $sqlLimit = (empty($top)) ? " LIMIT 5 " : null;

        if (!empty($tail)) $sqlAdd = " AND id < '" . intval($tail) . "' ";
        if (!empty($top)) $sqlAdd = " AND id > '" . intval($top) . "' ";

        if (!empty($id)) $sqlAdd .= " AND id = '" . intval($id) . "' ";

        $sql = "SELECT pp.*
            FROM pagePosts pp
            WHERE `deleted` = 0
                {$sqlAdd}
            ORDER BY datestamp DESC {$sqlLimit}";

        $query = $this->db->query($sql);

        $results = $query->result();

        

        if (!empty($id)) return $results[0]; // returns only first row if getting by ID

    return $results;
    }
}
