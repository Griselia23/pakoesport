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
        $match_id = $this->input->post('match_title');
        $team_1_score = $this->input->post('team_1_score');
        $team_2_score = $this->input->post('team_2_score');
    
        log_message('debug', 'match_id: ' . $match_id);
        log_message('debug', 'team_1_score: ' . $team_1_score . ' team_2_score: ' . $team_2_score);
        list($team_a_id, $team_b_id) = explode('-', $match_id);
        
        log_message('debug', 'Parsed team_a_id: ' . $team_a_id . ' team_b_id: ' . $team_b_id);
        
        if (!is_numeric($team_1_score) || !is_numeric($team_2_score)) {
            $this->session->set_flashdata('error', 'Scores must be numeric.');
            redirect('dashboard');
        }
        $match = $this->db->get_where('schedule', ['match_number' => $match_id])->row();
    
        log_message('debug', 'Match found: ' . print_r($match, true));
    
        if (!$match) {
            $this->session->set_flashdata('error', 'Match not found.');
            redirect('dashboard');
        }
        
        $data = array(
            'team_a_score' => $team_1_score,
            'team_b_score' => $team_2_score
        );
        
        $this->db->where('id', $match->id);
        $this->db->update('schedule', $data);
        
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Score updated successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to update score. Please try again.');
        }
        
        redirect('dashboard');
    }
    

}
