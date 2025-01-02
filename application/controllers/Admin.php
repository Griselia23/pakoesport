<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        if (!$this->session->userdata('user_id')) {
            // If not logged in, redirect to the login page
            redirect('login');
        }
        $this->load->model('Dashboard_model'); 
    }

    // Display the registration form with teams
    public function index() {
        // Fetch all teams from the database
        $data['teams'] = $this->Dashboard_model->get_all_teams();
        
        // Load the view and pass the data
        $this->load->view('admin', $data);
    }

    // Fetch the details of a specific team to edit
    public function edit_team($team_id) {
        // Get team data from the model
        $data['team'] = $this->Dashboard_model->get_team_by_id($team_id);
        
        // Load the edit modal with the team data
        $this->load->view('edit_modal', $data); 
    }

    // Update the team details in the database
    public function update_team() {
        $team_id = $this->input->post('team_id');
        $team_name = $this->input->post('teamName');
        $plant = $this->input->post('plant');
        $leader_name = $this->input->post('leaderName');
        $division = $this->input->post('division');
        $points = $this->input->post('points');

        // Data array to update
        $data = array(
            'team' => $team_name,
            'plant' => $plant,
            'leadername' => $leader_name,
            'division' => $division,
            'points' => $points
        );

        // Call the model method to update the team
        $this->Dashboard_model->update_team($team_id, $data);

        // Redirect back to the teams list page after the update
        redirect('admin');
    }

    // Delete a team from the database
    public function delete_team($team_id) {
        // Call the model method to delete the team
        $this->Dashboard_model->delete_team($team_id);

        // Redirect back to the teams list page after the deletion
        redirect('admin');
    }

    public function save_schedule() {
        // Get data from the form
        $matchNumber = $this->input->post('matchNumber');
        $division = $this->input->post('division');  // Either 'ml' or 'fifa'
        $startDate = $this->input->post('startDate');
        $startTime = $this->input->post('startTime');
        $endDate = $this->input->post('endDate');
        $endTime = $this->input->post('endTime');

        // Prepare the data to be saved
        $data = array(
            'match_number' => $matchNumber,
            'division' => $division,  // Save the selected division ('ml' or 'fifa')
            'start_date' => $startDate,
            'start_time' => $startTime,
            'end_date' => $endDate,
            'end_time' => $endTime,
        );

        // Call the model to save the schedule
        $this->load->model('Dashboard_model');
        $this->Dashboard_model->save_schedule($data);

        // Redirect to the page that displays all schedules
        redirect('admin');
    }
}
