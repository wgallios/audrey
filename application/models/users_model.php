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

            $sqlWhere = " AND id = '{$id}' ";
        }

        $sql = "SELECT *
            , codeDisplay(1, status) statusDisplay
            FROM users
            WHERE `status` <> 3
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

    /**
     * Checks if a username is in use
     *
     * @param String $username
     *
     * @return boolean - True if username is in use, false otherwise
     */
    public function checkUsernameInUse($username)
    {
        $username = $this->db->escape_str($username);

        $sql = "SELECT COUNT(*) cnt FROM users WHERE username = '{$username}'";

        $query = $this->db->query($sql);

        $results = $query->result();

        if ((int) $results[0]->cnt > 0) return true;

    return false;
    }

    /**
     * Inserts a new user
     *
     * @param arrayd $p
     *
     * @return INT - userid
     */
    public function createNew($p)
    {
        $p = $this->functions->recursiveClean($p);

        // sets them as a default user
        $sql = "INSERT INTO users SET
            datestamp = NOW(),
            username = '{$p['username']}',
            passwd = SHA1('{$p['password']}'),
            firstName = '{$p['firstName']}',
            lastName = '{$p['lastName']}',
            email = '{$p['email']}',
            status = '1',
            permissions = '2'";

        $this->db->query($sql);

    return $this->db->insert_id();
    }

    /**
     * Checks if a users password is correct
     *
     * @param Int $userid  
     * @param String $passord 
     *
     * @return boolean - True if correct password, false if not
     */
    public function checkPassword($userid, $password)
    {
        $userid = intval($userid);
        $password = $this->db->escape_str($password);

        if (empty($userid)) throw new Exception("userid is empty!");
        if (empty($password)) throw new Exception("password is empty!");

        $sql = "SELECT COUNT(*) cnt FROM users WHERE userid = '{$userid}' AND passwd = SHA1('{$password}')";

        $query = $this->db->query($sql);

        $results = $query->result();

        if ((int) $results[0]->cnt > 0) return true;

    return false;
    }

    /**
     * TODO: short description.
     *
     * @param mixed $userid   
     * @param mixed $password 
     *
     * @return TODO
     */
    public function updatePassword($userid, $password)
    {
        $userid = intval($userid);
        $password = $this->db->escape_str($password);

        if (empty($userid)) throw new Exception("userid is empty!");
        if (empty($password)) throw new Exception("password is empty!");

        $sql = "UPDATE users SET passwd = SHA1('{$password}') WHERE userid = '{$userid}'";

    return true;
    }

    /**
     * TODO: short description.
     *
     * @param array $p - $_POST array
     *
     * @return TODO
     */
    public function saveSettings($p)
    {
        $p = $this->functions->recursiveClean($p);

        $p['id'] = intval($p['id']);

        if (empty($p['id'])) throw new Exception("user id is empty!");

        (int) $perms = 0;

        if (!empty($_POST['permission']))
        {
            foreach ($p['permission'] as $bit)
            {
                $perms = $perms + (int) $bit;
            }
        }

        $sql = "UPDATE users SET
            username = '{$p['username']}',
            firstName = '{$p['firstName']}',
            lastName = '{$p['lastName']}',
            status = '{$p['status']}',
            email = '{$p['email']}',
            permissions = '{$perms}'
            WHERE id = '{$p['id']}'";

        $this->db->query($sql);

    return true;
    }
}
