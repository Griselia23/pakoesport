<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
        if ($this->session->userdata('role') !== 'admin') {
            redirect('login');  
        }

        $this->load->model('Dashboard_model'); 
        $this->load->model('Admin_model'); 
    }

    public function index() {
        $data['teams'] = $this->Dashboard_model->get_all_teams();
        $data['schedules'] = $this->Dashboard_model->get_all_schedules();
        $data['match_titles'] = $this->Admin_model->matchmaking();  
        $data['results'] = $this->Dashboard_model->get_all_match_results();
        $this->load->view('admin', $data);
    }

    public function edit_team($team_id) {
        $data['team'] = $this->Dashboard_model->get_team_by_id($team_id);
        $this->load->view('edit_modal', $data); 
    }
    
    public function update_team() {
        $team_id = $this->input->post('team_id');
        $team_name = $this->input->post('teamName');
        $plant = $this->input->post('plant');
        $leader_name = $this->input->post('leaderName');
        $division = $this->input->post('division');
        $points = $this->input->post('points');

        $data = array(
            'team' => $team_name,
            'plant' => $plant,
            'leadername' => $leader_name,
            'division' => $division,
            'points' => $points
        );

        $this->Dashboard_model->update_team($team_id, $data);
        redirect('admin');
    }

    public function delete_team($team_id) {
        $this->Dashboard_model->delete_team($team_id);
        redirect('admin');
    }

    public function save_schedule() {
        $matchNumber = $this->input->post('matchNumber');
        $division = $this->input->post('division');
        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');
    
        $matches = $this->db->query("
            SELECT 
                a.id AS team_a_id,
                b.id AS team_b_id,
                CONCAT(a.team, ' vs. ', b.team) AS match_title
            FROM 
                register a
            JOIN 
                register b ON a.division = b.division
            WHERE 
                a.division = ? AND a.id < b.id
        ", [$division])->result_array();
    
        $currentDate = $startDate;
        $matchesIndex = 0;
    
        while (strtotime($currentDate) <= strtotime($endDate)) {
            $matchesScheduled = 0;
    
            while ($matchesScheduled < 2 && $matchesIndex < count($matches)) {
                $match = $matches[$matchesIndex];
                $data = [
                    'match_number' => $matchNumber,
                    'division' => $division,
                    'start_date' => $currentDate,
                    'end_date' => $currentDate,
                    'match_title' => $match['match_title'],
                    'team_a_id' => $match['team_a_id'],
                    'team_b_id' => $match['team_b_id'],
                ];
                $this->Dashboard_model->save_schedule($data);
                $matchesScheduled++;
                $matchesIndex++;
            }
    
            $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
        }
    
        redirect('admin');
    }
    

    public function update_schedule($id) {
        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');
    
        // Get the schedule to update by its ID
        $schedule = $this->db->get_where('schedule', ['id' => $id])->row();
    
        // Check if the schedule exists
        if ($schedule) {
            $data = [
                'start_date' => $startDate,
                'end_date' => $endDate
            ];
    
            // Update the schedule in the database using the ID
            $this->db->where('id', $id);
            $this->db->update('schedule', $data);
        }
    
        redirect('admin');
    }
    
    
    
    
    public function delete_schedule($id) {
        $this->Dashboard_model->delete_schedule($id);
        redirect('admin');
    }

    public function update_results($id) {
        $teamnumber1 = $this->input->post('teamnumber1');
        $teamnumber2 = $this->input->post('teamnumber2');
        $teampoints1 = $this->input->post('teampoints1');
        $teampoints2 = $this->input->post('teampoints2');
        $division = $this->input->post('division');
        $matchdate = $this->input->post('matchdate');
        $title = $this->input->post('title');
        $evidence = $this->input->post('evidence');
        
        
        $data = array(
            'team_id_a' => $teamnumber1,
            'team_id_b' => $teamnumber2,
            'points_a' => $teampoints1,
            'points_b' => $teampoints2,
            'division' => $division,
            'match_date' => $matchdate,
            'evidence_image' => $evidence,
            'match_title' => $title,

        );
        
        $this->Dashboard_model->update_match_results($id, $data);
        redirect('admin');
    }

    public function delete_results($id) {
        $this->Dashboard_model->delete_match_results($id);
        redirect('admin');
    }


    }

    //


    



