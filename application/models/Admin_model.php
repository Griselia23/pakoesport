<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Ensure the database is loaded using CI's built-in method
    }

    public function get_schedules_with_teams($division = NULL, $sections = 1) {
    $query = "SELECT s.*, t1.team AS team_1_name, t2.team AS team_2_name
              FROM schedule AS s
              LEFT JOIN register AS t1 ON s.team_1_id = t1.id
              LEFT JOIN register AS t2 ON s.team_2_id = t2.id
              WHERE s.division = ?";

    // Add sorting based on sections
    if ($sections == 1) {
        $query .= " ORDER BY RAND()";
    } else {
        $query .= " ORDER BY points DESC";
    }

    // Run the query and return the results
    $query = $this->db->query($query, array($division));
    return $query->result();  // Ensure the query returns results as objects with properties
}

}
