<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TODO: short description.
 *
 * TODO: long description.
 *
 */
class sitesettings_model extends CI_Model
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
     * @param array $p - post array
     *
     * @return TODO
     */
    public function updateSettings ($p)
    {

        $p = $this->functions->recursiveClean($p);

        if (empty($p['domain'])) throw new Exception('domain is empty!');

        $gaid = (empty($p['googleAnalyticsID'])) ? 'NULL' : "'{$p['googleAnalyticsID']}'";

        $sql = "UPDATE settings SET
            domain = '{$p['domain']}',
            seoCrawable = '{$p['seoCrawable']}',
            googleAnalyticsID = {$gaid}";

        $this->db->query($sql);

        return true;
    }
}
