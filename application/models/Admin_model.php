<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); 
    }
    public function get_schedules_with_teams($division = NULL, $sections = 1) {
        $query = "SELECT * FROM register WHERE division = :division";
    
        if ($sections == 1) {
            $query .= " ORDER BY RAND()";
        } else {
            $query .= " ORDER BY points DESC";
        }
    
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':division', $division, PDO::PARAM_STR);
        $stmt->execute();
        $teams = $stmt->fetchAll();
    
        $matches = [];
    
        if ($sections == 1) {
            shuffle($teams);
            $matches = array_chunk($teams, 2);
        } else {
            $matches = array_chunk($teams, 2);
        }
    
        return $matches;
    }
    
    
    


    
}
