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
        $data['match_titles'] = $this->Admin_model->matchmaking();  // Get match titles
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
        $sections = $this->input->post('sections');
        
        $data = array(
            'match_number' => $matchNumber,
            'division' => $division,
            'start_date' => $startDate,
            'sections' => $sections
        );
        
        $this->Dashboard_model->save_schedule($data);
        redirect('admin');
    }

    public function update_schedule($id) {
        $matchNumber = $this->input->post('matchNumber');
        $division = $this->input->post('division');
        $startDate = $this->input->post('startDate');
        $sections = $this->input->post('sections');
        
        $data = array(
            'match_number' => $matchNumber,
            'division' => $division,
            'start_date' => $startDate,
            'sections' => $sections
        );
        
        $this->Dashboard_model->update_schedule($id, $data);
        redirect('admin');
    }

    public function delete_schedule($id) {
        $this->Dashboard_model->delete_schedule($id);
        redirect('admin');
    }

    public function get_match_titles() {
        $this->load->model('Admin_model');
        $match_titles = $this->Admin_model->matchmaking();
        print_r($match_titles);
    }
}
