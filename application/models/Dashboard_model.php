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

    public function save_schedule($data) {
        // Insert the data into the 'schedule' table
        $this->db->insert('schedule', $data);
    }

    // Function to get all schedules
    public function get_all_schedules() {
        $query = $this->db->get('schedule');
        return $query->result();
    }
}
