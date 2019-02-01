<?php
/**
 * Created by PhpStorm.
 * User: Elman
 * Date: 01.02.2019
 * Time: 20:44
 */

class Reviews_model extends CI_Model{

    public function show_all_reviews()
    {

        $this->db->where('approved', '1');
        $this->db->select('id, header, excerpt, created_date, author_id');
        $query = $this->db->get('reviews');

        $data = $query->result();

        return $data;

    }

    public function add($title, $excerpt, $clean_review, $current_user_id)
    {
        $review_data = [

            'header'    => $title,
            'excerpt'  => $excerpt,
            'author_id'  => $current_user_id,
            'full_text' => $clean_review

        ];

        $query = $this->db->insert('reviews', $review_data);

        if($query === TRUE) return true;
        return false;
    }

    public function show_reviews()
    {

    }

}