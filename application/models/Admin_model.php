<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); 
    }

    public function matchmaking() {
        $query = "
            SELECT 
                a.id AS team_a_id,
                a.division AS categ,
                a.team AS team_a_name,
                b.id AS team_b_id,
                b.team AS team_b_name,
                CONCAT(a.team, ' vs. ', b.team) AS match_title,
                s.start_date AS match_day
            FROM 
                register a
            CROSS JOIN 
                register b
            JOIN 
                schedule s ON a.division = s.division
            WHERE 
                a.id < b.id 
                AND a.division = b.division
            ORDER BY 
                a.division, a.team, b.team;
        ";
    
        // Execute the query and fetch results
        $result = $this->db->query($query);
    
        return $result->result_array();
    }
    
    public function results() {
        $query = "
            SELECT 
                a.id AS team_a_id,
                a.division AS categ,
                a.team AS team_a_name,
                b.id AS team_b_id,
                b.team AS team_b_name,
                CONCAT(a.team, ' vs. ', b.team) AS match_title,
                s.start_date AS match_day
            FROM 
                register a
            CROSS JOIN 
                register b
            JOIN 
                schedule s ON a.division = s.division
            WHERE 
                a.id < b.id 
                AND a.division = b.division
                AND s.team_1_id = a.id
                AND s.team_2_id = b.id
            ORDER BY 
                a.division, a.team, b.team;
        ";
    
        // Execute the query and fetch results
        $result = $this->db->query($query);
    
        return $result->result_array();
    }

    // Method to save the result of the match
    public function save_result($team_1_id, $team_2_id, $team_1_score, $team_2_score, $evidence_path) {
        // Update the points in the register table for both teams
        $this->db->where('id', $team_1_id);
        $this->db->set('points', 'points + ' . (int)$team_1_score, FALSE);  // Increment points by team score
        $this->db->update('register');

        $this->db->where('id', $team_2_id);
        $this->db->set('points', 'points + ' . (int)$team_2_score, FALSE);  // Increment points by team score
        $this->db->update('register');

        // Insert result record into results table (or create one)
        $data = array(
            'team_1_id' => $team_1_id,
            'team_2_id' => $team_2_id,
            'team_1_score' => $team_1_score,
            'team_2_score' => $team_2_score,
            'evidence' => $evidence_path,  // Store the path of the uploaded file
            'created_at' => date('Y-m-d H:i:s')
        );

        $this->db->insert('match_results', $data);
    }

    // Method to handle the file upload and return the file path
    public function upload_evidence() {
        $config['upload_path'] = './uploads/evidence/'; // Path to store uploaded files
        $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf'; // Allowed file types
        $config['max_size'] = 2048; // Max file size (2MB)

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('evidence')) {
            // If upload failed, return an error
            return array('error' => $this->upload->display_errors());
        } else {
            // Return the file path if upload succeeded
            $data = $this->upload->data();
            return $data['file_name']; // Return file name for storage in the database
        }
    }
}
