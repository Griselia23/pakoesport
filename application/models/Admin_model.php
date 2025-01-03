<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Ensure the database connection is loaded
    }
    public function get_schedules_with_teams($division = NULL) {
        $this->db->select('schedule.id, 
                           schedule.match_number, 
                           schedule.division, 
                           schedule.start_date, 
                           schedule.start_time, 
                           schedule.end_date, 
                           schedule.end_time, 
                           register1.team as team_1, 
                           register2.team as team_2');
        $this->db->from('schedule');
        $this->db->join('register AS register1', 'schedule.team_1_id = register1.id', 'left');
        $this->db->join('register AS register2', 'schedule.team_2_id = register2.id', 'left');
        
        if ($division) {
            $this->db->where('schedule.division', $division);
        }
        
        // Execute the query
        $query = $this->db->get();
        
        // Return the result as an array of objects
        return $query->result();
    }
    
    


    
}
