<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function insert_team($data) {
        return $this->db->insert('register', $data); 
    }
    
    public function get_all_teams() {
        $this->db->select('id, team, plant, leadername, division, points');
        $query = $this->db->get('register');
        return $query->result();
    }
    
    public function get_team_by_id($team_id) {
        $this->db->where('id', $team_id);
        $query = $this->db->get('register');
        return $query->row();
    }
    
    public function update_team($team_id, $data) {
        $this->db->where('id', $team_id);
        return $this->db->update('register', $data); 
    }
    
    public function delete_team($team_id) {
        $this->db->where('id', $team_id);
        return $this->db->delete('register');
    }

    public function get_all_user() {
        $this->db->select('id, username, npk');
        $query = $this->db->get('user');
        return $query->result();
    }

    public function add_user($data) {
        return $this->db->insert('user', $data);
    }

    public function get_user_by_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('user');
        return $query->row();
    }

    public function update_user($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('user', $data);
    }

    public function delete_user($id) {
        $this->db->where('id', $id);
        return $this->db->delete('user');
    }



    // scheduling

    public function get_all_schedules() {
        return $this->db->get('schedule')->result();
    }
    
    public function save_schedule($data) {
        $this->db->insert('schedule', $data);
    }
    
    public function update_schedule($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('schedule', $data);
    }
    
    public function delete_schedule($id) {
        $this->db->where('id', $id);
        $this->db->delete('schedule');
    }

    public function get_match_by_number($match_number) {
        $this->db->select('s.team_a_id, s.team_b_id');
        $this->db->from('schedule s');
        $this->db->join('register a', 'a.id = s.team_a_id');
        $this->db->join('register b', 'b.id = s.team_b_id');
        $this->db->where('s.match_number', $match_number);
        
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->row_array(); // Return the team IDs
        }
        
        return null; // Return null if no match is found
    }
    
    

}
