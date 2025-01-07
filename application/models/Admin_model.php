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
    
    
    
    
}
