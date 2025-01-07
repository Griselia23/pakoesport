<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); 
    }

    public function matchmaking() {
        $query = "SELECT 
                    CONCAT(a.team, ' vs. ', b.team) AS match_title
                  FROM register a
                  JOIN register b ON a.division = b.division
                  JOIN schedule s ON a.division = s.division
                  WHERE a.id < b.id
                  ORDER BY CONCAT(SUBSTRING(a.team, 4), SUBSTRING(b.team, 3)) ASC;";
    
        // Execute the query and fetch results
        $result = $this->db->query($query);
        // Extract match titles into a simple array of strings
        $titles = array_column($result->result_array(), 'match_title');
        
        return $titles;  // Return an array of match titles
    }
    
}
