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
        $this->load->model('Dashboard_model'); 
        $this->load->model('Admin_model'); 
    }

    public function index() {
        $data['teams'] = $this->Dashboard_model->get_all_teams();
        $data['schedules'] = $this->Dashboard_model->get_all_schedules();
        $data['match_titles'] = $this->Admin_model->matchmaking();  
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
        
        
        $data = array(
            'match_number' => $matchNumber,
            'division' => $division,
            'start_date' => $startDate
            
        );
        
        $this->Dashboard_model->save_schedule($data);
        redirect('admin');
    }

    public function update_schedule($id) {
        $matchNumber = $this->input->post('matchNumber');
        $division = $this->input->post('division');
        $startDate = $this->input->post('startDate');
        
        
        $data = array(
            'match_number' => $matchNumber,
            'division' => $division,
            'start_date' => $startDate
        );
        
        $this->Dashboard_model->update_schedule($id, $data);
        redirect('admin');
    }

    public function delete_schedule($id) {
        $this->Dashboard_model->delete_schedule($id);
        redirect('admin');
    }

    public function upload_result() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Capture form data
            $team_1_id = $this->input->post('team1');
            $team_2_id = $this->input->post('team2');
            $team_1_score = $this->input->post('team_1_score');
            $team_2_score = $this->input->post('team_2_score');
    
            // Handle file upload
            $evidence = $this->Admin_model->upload_evidence();
            if (isset($evidence['error'])) {
                // Handle error if file upload fails
                $this->session->set_flashdata('error', $evidence['error']);
                redirect('dashboard');
            }
    
            // Save the result
            $this->Admin_model->save_result($team_1_id, $team_2_id, $team_1_score, $team_2_score, $evidence);
            
            // Redirect to admin dashboard or result page
            $this->session->set_flashdata('success', 'Match result saved successfully!');
            redirect('dashboard');
        }
    }
    




}
