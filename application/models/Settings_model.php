<?php
/**
 * Created by PhpStorm.
 * User: Elman
 * Date: 06.02.2019
 * Time: 1:28
 */

class Settings_model extends CI_Model{

    public function update_settings($updated_data = null)
    {

        if(!is_logged_in() || is_null($updated_data)) return false;


        $affected_rows = 0;
        foreach ($updated_data as $key => $value) {
            $this->db->where('name', $key);
            $this->db->update('settings', ['value' => $value]);
            $affected_rows += $this->db->affected_rows();
        }


        if($affected_rows > 0) return true;

        return false;
    }
}
