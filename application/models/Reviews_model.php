<?php
/**
 * Created by PhpStorm.
 * User: Elman
 * Date: 01.02.2019
 * Time: 20:44
 */

class Reviews_model extends CI_Model{

    public function get_all_reviews($posts_start_count = 1)
    {
        if(!is_logged_in()) return false;

        if($posts_start_count === 1){
            $posts_start_count = 0;
        }


        $this->db->select('id, header, created_date, author_id');
        $this->db->order_by('created_date', 'desc');
        $this->db->limit(POSTS_PER_PAGE, $posts_start_count);
        $query = $this->db->get('reviews');


        $data = $query->result();

        return $data;


    }

    public function approve_review($id)
    {
        if(!is_logged_in() || !isset($id)) return false;

        $this->db->set('approved', 1);
        $this->db->where('id', $id);
        $this->db->update('reviews');
        $result = $this->db->affected_rows();

        if($result === 1)
        {
            return TRUE;
        }
        return FALSE;
    }

    public function delete_review($id)
    {
        if(!is_logged_in() || !isset($id)) return false;

        $this->db->where('id', $id);
        $this->db->delete('reviews');
        $result = $this->db->affected_rows();

        if($result === 1)
        {
            return TRUE;
        }
        return FALSE;

    }

    public function get_unapproved_reviews()
    {
        if(!is_logged_in()) return false;

        $this->db->select('id, header, created_date, author_id');
        $this->db->where('approved', '0');
        $query = $this->db->get('reviews');
        $data = $query->result();

        return $data;
    }

    public function get_total_page_count()
    {
        $this->db->where('approved', '1');
        $this->db->select('count(*) as posts_count');
        $query = $this->db->get('reviews');

        $result = $query->result();

        $reviews_total_count = $result[0]->posts_count;

        return $reviews_total_count;
    }

    public function show($id)
    {
        if(!isset($id) || !is_int($id)) return false;

        $this->db->where('id', (int) $id);
        $this->db->select('header, full_text, created_date, author_id');
        $query = $this->db->get('reviews');

        $data = $query->result();

        return $data;

    }

    public function show_reviews($posts_start_count = 1)
    {
        if($posts_start_count === 1){
            $posts_start_count = 0;
        }


        $this->db->select('id, header, excerpt, created_date, author_id');
        $this->db->where('approved', '1');
        $this->db->order_by('created_date', 'desc');
        $this->db->limit(POSTS_PER_PAGE, $posts_start_count);
        $query = $this->db->get('reviews');


        $data = $query->result();


        return $data;

    }

    public function add($title, $excerpt, $clean_review, $current_user_id, $user_status)
    {
        if(!is_logged_in()) return false;

        if($user_status === 7){
            $approved = 1;
        }
        else{
            $approved = 0;
        }

        $review_data = [

            'header'    => $title,
            'excerpt'   => $excerpt,
            'author_id' => $current_user_id,
            'approved'  => $approved,
            'full_text' => $clean_review

        ];

        $query = $this->db->insert('reviews', $review_data);

        if($query === TRUE) return true;
        return false;
    }


}