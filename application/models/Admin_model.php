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
    team_a_id,
    team_b_id,
    categ,
    team_a_name,
    team_b_name,
    match_title,
    match_day,
    match_end_day,
    team_a_points,  
    team_b_points,  
    winner,
    match_id
FROM (
    SELECT 
        a.id AS team_a_id,
        b.id AS team_b_id,
        a.division AS categ,
        a.team AS team_a_name,  
        b.team AS team_b_name,  
        CONCAT(a.team, ' vs. ', b.team) AS match_title,
        DATE_ADD(s.start_date, INTERVAL ((@row_num := IF(@prev_division = a.division, @row_num + 1, 1)) - 1) DIV 2 DAY) AS match_day,
        s.end_date AS match_end_day,
        COALESCE(mr.points_a, 0) AS team_a_points,  
        COALESCE(mr.points_b, 0) AS team_b_points,  
        CASE
            WHEN mr.points_a > mr.points_b THEN a.team 
            WHEN mr.points_b > mr.points_a THEN b.team  
            ELSE 'Draw'                          
        END AS winner,
        mr.id AS match_id,
        @prev_division := a.division
    FROM 
        register a
    JOIN 
        register b ON a.division = b.division
    JOIN 
        schedule s ON a.division = s.division
    LEFT JOIN 
        match_results mr ON (a.id = mr.team_id_a AND b.id = mr.team_id_b) 
        OR (a.id = mr.team_id_b AND b.id = mr.team_id_a)
    CROSS JOIN 
        (SELECT @row_num := 0, @prev_division := '') AS init_var
    WHERE 
        a.id < b.id
        AND a.division IN ('ml', 'fifa')
        AND s.start_date >= CURDATE()
        AND s.end_date >= CURDATE()
) AS match_list
WHERE 
    match_day <= match_end_day
ORDER BY 
    categ, match_day;
        ";
        $result = $this->db->query($query);
    
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return [];  
        }
    }
}


// SELECT 
//             a.id AS team_a_id,
//             b.id AS team_b_id,
//             a.division AS categ,
//             a.team AS team_a_name,  
//             b.team AS team_b_name,  
//             CONCAT(a.team, ' vs. ', b.team) AS match_title,
//             s.start_date AS match_day,
//             COALESCE(mr.points_a, 0) AS team_a_points,  
//             COALESCE(mr.points_b, 0) AS team_b_points,
//             CASE
//                 WHEN mr.points_a > mr.points_b THEN a.team 
//                 WHEN mr.points_b > mr.points_a THEN b.team  
//                 ELSE 'Draw'                          
//             END AS winner,
//             mr.id AS match_id  
//         FROM 
//             register a
//         JOIN 
//             register b ON a.division = b.division
//         JOIN 
//             schedule s ON a.division = s.division
//         LEFT JOIN 
//             match_results mr ON (a.id = mr.team_id_a AND b.id = mr.team_id_b) 
//             OR (a.id = mr.team_id_b AND b.id = mr.team_id_a)
//         WHERE 
//             a.id < b.id
//             AND a.division IN ('ml', 'fifa');