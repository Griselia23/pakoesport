<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Dashboard_model');
        $this->load->model('Admin_model');
    }

    public function index() {
        $matches = $this->Admin_model->matchmaking();
        log_message('debug', 'Matches Query Result: ' . print_r($matches, true));

        if ($matches) {
            $grouped_matches = [];
            foreach ($matches as $match) {
                $grouped_matches[$match['categ']][] = $match;
            }
            $data['matches_by_division'] = $grouped_matches;
        } else {
            $data['matches_by_division'] = [];
        }

        $this->load->view('dashboard', $data);
    }

    public function submit_registration() {
        $data = array(
            'team' => $this->input->post('team'),
            'plant' => $this->input->post('plant'),
            'leadernpk' => $this->input->post('leadernpk'),
            'leadername' => $this->input->post('leadername'),
            'number' => $this->input->post('number'),
            'member1npk' => $this->input->post('member1npk'),
            'member1name' => $this->input->post('member1name'),
            'member2npk' => $this->input->post('member2npk'),
            'member2name' => $this->input->post('member2name'),
            'member3npk' => $this->input->post('member3npk'),
            'member3name' => $this->input->post('member3name'),
            'member4npk' => $this->input->post('member4npk'),
            'member4name' => $this->input->post('member4name'),
            'member5npk' => $this->input->post('member5npk'),
            'member5name' => $this->input->post('member5name'),
            'division' => $this->input->post('division'),
        );

        if ($this->Dashboard_model->insert_team($data)) {
            $this->session->set_flashdata('success', 'Team registered successfully.');
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('error', 'There was an error with the registration.');
            redirect('dashboard');
        }
    }

    public function submit_score() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $match_id = $this->input->post('match_title');
            $team_a_score = $this->input->post('team_1_score');
            $team_b_score = $this->input->post('team_2_score');
            $team_a_id = $this->input->post('team_a_id');
            $team_b_id = $this->input->post('team_b_id');
        
            list($team_a_id, $team_b_id) = explode('-', $match_id);
        
            $team_a = $this->db->get_where('register', ['id' => $team_a_id])->row_array();
            $team_b = $this->db->get_where('register', ['id' => $team_b_id])->row_array();
        
            // Directly add the score to the team's points without condition
            $team_a_new_points = $team_a['points'] + $team_a_score;
            $team_b_new_points = $team_b['points'] + $team_b_score;
        
            // Update the points in the database
            $update_team_a = $this->db->update('register', ['points' => $team_a_new_points], ['id' => $team_a_id]);
            $update_team_b = $this->db->update('register', ['points' => $team_b_new_points], ['id' => $team_b_id]);
        
            // Check if both updates were successful
            if ($update_team_a && $update_team_b) {
                // Set flashdata for success
                $this->session->set_flashdata('success', 'Scores submitted and points updated successfully!');
            } else {
                // Set flashdata for error if something went wrong
                $this->session->set_flashdata('error', 'There was an issue updating the scores.');
            }
        
            // Redirect to the dashboard
            redirect('dashboard');
        }
    }
    
    
    

    
    
    
    
    
    
    
    
    

}
