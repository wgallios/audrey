<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings
{

    /**
     * TODO: description.
     *
     * @var mixed
     */
    public $settings = null;

    public function __construct()
    {
        // if connected to DB
        if (class_exists('CI_DB'))
        {
            // if settings have not been defined - will get settings
            if ($this->settings == null) $this->settings = $this->getSettings();
        }
    }


    /**
     * Gets sites settings
     *
     * @return object
     */
    public function getSettings()
    {
        $ci =& get_instance();

        $sql = "SELECT *
            , codeDisplay(2, relationshipStatus) rssDisplay
            , codeDisplay(4, gender) genderDisplay
            , FLOOR(DATEDIFF(NOW(), dob) / 365.25) as age
            FROM settings";

        $query = $ci->db->query($sql);

        $results = $query->result();

    return $results[0];
    }

    /**
     * TODO: short description.
     *
     * @param mixed $col 
     *
     * @return TODO
     */
    public function item ($col)
    {
        return $this->settings->$col;
    }
}
