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
        $data['users'] = $this->Dashboard_model->get_all_user();
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

        $ml_leaderboard = [];
        $fifa_leaderboard = [];

        // Process the matches to update the leaderboards
        foreach ($matches as $match) {
            if ($match['categ'] == 'ml') {
                $this->mlLeaderboard($ml_leaderboard, $match);
            } elseif ($match['categ'] == 'fifa') {
                $this->fifaLeaderboard($fifa_leaderboard, $match);
            }
        }

        // Sort both leaderboards based on points, then wins if points are equal
        usort($ml_leaderboard, function($a, $b) { 
            return $b['points'] - $a['points'] ?: $b['win'] - $a['win']; 
        });
        usort($fifa_leaderboard, function($a, $b) { 
            return $b['points'] - $a['points'] ?: $b['win'] - $a['win']; 
        });

        // Pass the leaderboard data to the view
        $data['ml_leaderboard'] = $ml_leaderboard;
        $data['fifa_leaderboard'] = $fifa_leaderboard;

        $this->load->view('dashboard', $data);
    }

    public function submit_registration() {
        $password = $this->input->post('password');
        $data = array(
            'team' => $this->input->post('team'),
            'plant' => $this->input->post('plant'),
            'npk' => $this->input->post('npk'),
            'leadername' => $this->input->post('leadername'),
            'number' => $this->input->post('number'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
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
            'division' => $this->input->post('division')
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
            $division = $this->input->post('division'); 
    
            list($team_a_id, $team_b_id) = explode('-', $match_id);
    
            $team_a = $this->db->get_where('register', ['id' => $team_a_id])->row_array();
            $team_b = $this->db->get_where('register', ['id' => $team_b_id])->row_array();
    
            $team_a_new_points = $team_a['points'];
            $team_b_new_points = $team_b['points'];
    
            if ($team_a_score > $team_b_score) {
                $team_a_new_points += 3;
            } elseif ($team_a_score < $team_b_score) {
                $team_b_new_points += 3;
            } else {
                $team_a_new_points += 1;
                $team_b_new_points += 1;
            }
    
            $upload_path = './uploads/' . $division . '/'; 
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, true);
            }
    
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 2048;
            $this->load->library('upload', $config);
    
            if ($this->upload->do_upload('evidence_image')) {
                $upload_data = $this->upload->data();
                $image_path = 'uploads/' . $division . '/' . $upload_data['file_name'];
    
                $match_result_data = [
                    'team_id_a' => $team_a_id,
                    'team_id_b' => $team_b_id,
                    'points_a' => $team_a_score,
                    'points_b' => $team_b_score,
                    'match_date' => date('Y-m-d H:i:s'),
                    'evidence_image' => $image_path,
                    'division' => $division
                ];
    
                $existing_match_result = $this->db->get_where('match_results', [
                    'team_id_a' => $team_a_id,
                    'team_id_b' => $team_b_id
                ])->row_array();
    
                if ($existing_match_result) {
                    // Update existing match result
                    $this->db->update('match_results', $match_result_data, [
                        'match_list_id' => $existing_match_result['match_list_id'] // Corrected here
                    ]);
                } else {
                    // Insert new match result and get the match_list_id
                    $this->db->insert('match_results', $match_result_data);
                    $match_list_id = $this->db->insert_id(); // Retrieve the match_list_id from the newly inserted row
                }
    
                // Update the points for both teams in the register table
                $this->db->update('register', ['points' => $team_a_new_points], ['id' => $team_a_id]);
                $this->db->update('register', ['points' => $team_b_new_points], ['id' => $team_b_id]);
    
                $this->session->set_flashdata('success', 'Scores and evidence image uploaded successfully!');
            } else {
                $this->session->set_flashdata('error', 'Image upload failed: ' . $this->upload->display_errors());
            }
    
            redirect('uploadresult');
        }
    }
    
    
    
    

    public function leaderboard() {
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

        $ml_leaderboard = [];
        $fifa_leaderboard = [];

        foreach ($matches as $match) {
            if ($match['categ'] == 'ml') {
                $this->mlLeaderboard($ml_leaderboard, $match);
            } elseif ($match['categ'] == 'fifa') {
                $this->fifaLeaderboard($fifa_leaderboard, $match);
            }
        }

        usort($ml_leaderboard, function($a, $b) { return $b['points'] - $a['points']; });
        usort($fifa_leaderboard, function($a, $b) { return $b['points'] - $a['points']; });

        $data['ml_leaderboard'] = $ml_leaderboard;
        $data['fifa_leaderboard'] = $fifa_leaderboard;

        $this->load->view('dashboard', $data);
    }

    private function mlLeaderboard(&$leaderboard, $match) {
        // Ensure both teams exist in the leaderboard
        if (!isset($leaderboard[$match['team_a_name']])) {
            $leaderboard[$match['team_a_name']] = [
                'team' => $match['team_a_name'],
                'play' => 0,
                'win' => 0,
                'lose' => 0,
                'points' => 0
            ];
        }
        if (!isset($leaderboard[$match['team_b_name']])) {
            $leaderboard[$match['team_b_name']] = [
                'team' => $match['team_b_name'],
                'play' => 0,
                'win' => 0,
                'lose' => 0,
                'points' => 0
            ];
        }
    
        // Increment play count for both teams
        $leaderboard[$match['team_a_name']]['play']++;
        $leaderboard[$match['team_b_name']]['play']++;
    
        // Update points for both teams
        $leaderboard[$match['team_a_name']]['points'] += $match['team_a_points'];
        $leaderboard[$match['team_b_name']]['points'] += $match['team_b_points'];

        // Update win/lose based on match result
        if ($match['team_a_points'] > $match['team_b_points']) {
            $leaderboard[$match['team_a_name']]['win']++;
            $leaderboard[$match['team_b_name']]['lose']++;
        } elseif ($match['team_a_points'] < $match['team_b_points']) {
            $leaderboard[$match['team_b_name']]['win']++;
            $leaderboard[$match['team_a_name']]['lose']++;
        } else {
            // Draw case: both teams get 1 point
            $leaderboard[$match['team_a_name']]['points'] += 1;
            $leaderboard[$match['team_b_name']]['points'] += 1;
        }
    }
    
    private function fifaLeaderboard(&$leaderboard, $match) {
            // Ensure both teams exist in the leaderboard
            if (!isset($leaderboard[$match['team_a_name']])) {
                $leaderboard[$match['team_a_name']] = [
                    'team' => $match['team_a_name'],
                    'play' => 0,
                    'win' => 0,
                    'lose' => 0,
                    'points' => 0
                ];
            }
            if (!isset($leaderboard[$match['team_b_name']])) {
                $leaderboard[$match['team_b_name']] = [
                    'team' => $match['team_b_name'],
                    'play' => 0,
                    'win' => 0,
                    'lose' => 0,
                    'points' => 0
                ];
            }
        
            // Increment play count for both teams
            $leaderboard[$match['team_a_name']]['play']++;
            $leaderboard[$match['team_b_name']]['play']++;
        
            // Update points for both teams
            $leaderboard[$match['team_a_name']]['points'] += $match['team_a_points'];
            $leaderboard[$match['team_b_name']]['points'] += $match['team_b_points'];
    
            // Update win/lose based on match result
            if ($match['team_a_points'] > $match['team_b_points']) {
                $leaderboard[$match['team_a_name']]['win']++;
                $leaderboard[$match['team_b_name']]['lose']++;
            } elseif ($match['team_a_points'] < $match['team_b_points']) {
                $leaderboard[$match['team_b_name']]['win']++;
                $leaderboard[$match['team_a_name']]['lose']++;
            } else {
                // Draw case: both teams get 1 point
                $leaderboard[$match['team_a_name']]['points'] += 1;
                $leaderboard[$match['team_b_name']]['points'] += 1;
            }
        }
}
