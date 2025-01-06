<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); 
    }

    public function get_schedules_with_teams() {
        $query = "SET @match_number = 0;

INSERT INTO schedule (sections, match_number, division, start_date, team_1_id, team_2_id)
SELECT 
    1 AS sections,
    @match_number := @match_number + 1 AS match_number,
    r1.division,
    CURDATE() AS start_date,
    r1.id AS team_1_id,
    r2.id AS team_2_id
FROM 
    register r1
JOIN 
    register r2 ON r1.division = r2.division AND r1.id < r2.id
ORDER BY 
    r1.division, r1.team, r2.team;
";
    
        
        $this->db->query($query);
    }
}
