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
    b.id AS team_b_id,
    a.division AS categ,
    a.team AS team_a_name,  
    b.team AS team_b_name,  
    CONCAT(a.team, ' vs. ', b.team) AS match_title,
    s.start_date AS match_day,
    a.points AS team_a_points,  
    b.points AS team_b_points  
FROM 
    register a
JOIN 
    register b ON a.division = b.division
JOIN 
    schedule s ON a.division = s.division
WHERE 
    a.id < b.id
    AND s.start_date IS NOT NULL
    AND a.division IN ('ml', 'fifa')
    AND s.team_a_score IS NOT NULL
    AND s.team_b_score IS NOT NULL;


        ";//these all insert to match_result
    
        // Execute the query and fetch results
        $result = $this->db->query($query);
    
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return [];  
        }

        
    }
    


    
    
}
