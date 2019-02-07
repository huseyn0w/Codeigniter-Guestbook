<?php
/**
 * Created by PhpStorm.
 * User: Elman
 * Date: 06.02.2019
 * Time: 1:28
 */

class Settings_model extends CI_Model{

    public function get_pages()
    {
        $this->db->select('title, url');
        if(!is_logged_in()) {
            $this->db->where('visibility IN (0,1)');
        }
        else{
            if(get_current_status() === 7){
                $this->db->where('visibility IN (1,2,3)');
            }
            else{
                $this->db->where('visibility IN (1,2)');
            }

        }


        $query = $this->db->get('front_pages');
        $data = $query->result();

        return $data;
    }

    public  function load_settings()
    {
        $query = $this->db->get('settings');
        $data = $query->result();

        return $data;
    }

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
