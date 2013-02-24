<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TODO: short description.
 *
 * TODO: long description.
 *
 */
class users_model extends CI_Model
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
     * @param mixed $id Optional, defaults to null. 
     *
     * @return TODO
     */
    public function getUsers($id = null)
    {
        if (!empty($id))
        {
            $id = intval($id);

            if (empty($id)) throw new Exception("ID is empty!");

            $sqlWhere = " WHERE id = '{$id}' ";
        }

        $sql = "SELECT *
            , codeDisplay(1, status) statusDisplay
            FROM users
            {$sqlWhere}
            ORDER BY firstName, lastName";

        $query = $this->db->query($sql);

        $results = $query->result();

        if (!empty($id)) return $results[0];

    return $results;
    }

    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function getPermissionsList($userId)
    {
        $userId = intval($userId);

        if (empty($userId)) throw new Exception("userId is empty!");

        $sql = "SELECT *
, (bit & (SELECT permissions FROM users WHERE id = '{$userId}')) as assigned
FROM permissions
WHERE active = 1
ORDER BY label";

        $query = $this->db->query($sql);

        $results = $query->result();

    return $results;
    }
}
