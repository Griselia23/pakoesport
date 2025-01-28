<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uploadresult extends CI_Controller {

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
    
        $matches = $this->Admin_model->matchmaking();
        log_message('debug', 'Matches Query Result: ' . print_r($matches, true));
    
        $user_role = $this->session->userdata('role'); 
    
        if ($user_role == 'member') {
            $user_team = $this->session->userdata('user_team');
        } else {
            $user_team = null;
        }
    
        // Get the current date (in Y-m-d format)
        $current_date = date('Y-m-d');
    
        if ($matches) {
            $grouped_matches = [];
            foreach ($matches as $match) {
                // Get the match schedule date (assuming it's in 'start_date' column)
                $match_date = $match['start_date']; // assuming match date is available here
    
                // Only include matches that are scheduled for today (current date)
                if ($match_date == $current_date) {
                    if ($user_role == 'member') {
                        if ($match['team_a_name'] == $user_team || $match['team_b_name'] == $user_team) {
                            $grouped_matches[$match['categ']][] = $match;
                        }
                    } else {
                        $grouped_matches[$match['categ']][] = $match;
                    }
                }
            }
            $data['matches_by_division'] = $grouped_matches;
        } else {
            $data['matches_by_division'] = [];
        }
    
        $this->load->view('uploadresult', $data);
    }
    
    
    
    
}