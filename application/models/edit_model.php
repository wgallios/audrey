<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TODO: short description.
 *
 * TODO: long description.
 *
 */
class edit_model extends CI_Model
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
     * @return object
     */
    public function getSettings()
    {
        $sql = "SELECT * FROM settings LIMIT 1";

        $query = $this->db->query($sql);

        $results = $query->result();

    return $results[0];
    }

    /**
     * Updates site settings
     *
     * @return boolean
     */
    public function saveSettings($p)
    {
        $p = $this->functions->recursiveClean($p);

        // ensures certain inputs that are meant to be INT's are only INT's
        $p['heightFeet'] = intval($p['heightFeet']);
        $p['heightInches'] = intval($p['heightInches']);
        $p['weight'] = intval($p['weight']);

        if (!empty($p['dob']))
        {
            $dobToTime = strtotime($p['dob']);

            if ($dobToTime == -1) throw new Exception("Unable to convert {$p['dob']} to Datetime!");

            $dob = "'" . date("Y-m-d", $dobToTime)  . "'";
        }
        else
        {
            $dob = 'NULL';
        }

        // updates some inputs to NULL of nothing is entered
        $gender = (empty($p['gender'])) ? 'NULL' : "'{$p['gender']}'";
        $heightFeet = (empty($p['heightFeet'])) ? 'NULL' : "'{$p['heightFeet']}'";
        $heightInches = (empty($p['heightInches'])) ? 'NULL' : "'{$p['heightInches']}'";
        $weight = (empty($p['weight'])) ? 'NULL' : "'{$p['weight']}'";
        $weightType = (empty($p['weightType'])) ? 'NULL' : "'{$p['weightType']}'";
        $relationshipStatus = (empty($p['relationshipStatus'])) ? 'NULL' : "'{$p['relationshipStatus']}'";

        $sql = "UPDATE settings
            SET firstName = '{$p['firstName']}'
            , lastName = '{$p['lastName']}'
            , dob = {$dob}
            , gender = {$gender}
            , heightFeet = {$heightFeet}
            , heightInches = {$heightInches}
            , weight = {$weight}
            , weightType = {$weightType}
            , relationshipStatus = {$relationshipStatus}
            , aboutMe = '{$p['aboutMe']}'";

        $this->db->query($sql);

    return true;
    }
}
