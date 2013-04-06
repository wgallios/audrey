<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TODO: short description.
 *
 * TODO: long description.
 *
 */
class auth_model extends CI_Model
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
     * @param mixed $username 
     * @param mixed $email    
     * @param mixed $domain   
     *
     * @return TODO
     */
    public function authSite($username, $email, $domain)
    {
        $p = array
            (
                'username' => $username,
                'email' => $email,
                'domain' => $domain
            );

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->config->item('authUrl'));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $p);

        $results = curl_exec($ch);

        curl_close($ch);

    return $results;
    }

    /**
     * TODO: short description.
     *
     * @param mixed $domain 
     *
     * @return TODO
     */
    public function verifySite ($domain)
    {
        $p = array
            (
                'domain' => $domain
            );

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->config->item('verifyUrl'));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $p);

        $results = curl_exec($ch);

        curl_close($ch);

    return $results;
    }

    /**
     * TODO: short description.
     *
     * @param mixed $key 
     *
     * @return TODO
     */
    public function saveKey($key)
    {
        $key = $this->db->escape_str($key);

        $sql = "UPDATE settings SET authKey = '{$key}'";

        $this->db->query($sql);

    return true;
    }

    /**
     * TODO: short description.
     *
     * @return TODO
     */
    public function getCurrentKey()
    {
        $sql = "SELECT authKey FROM settings";

        $query = $this->db->query($sql);

        $results = $query->result();

    return $results[0]->authKey;
    }
}
