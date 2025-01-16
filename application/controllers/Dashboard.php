<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Dashboard_model');
        $this->load->model('Admin_model');
    }

    public function index()
    {
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

        $ml_teams = $this->db->select('team, id')
            ->from('register')
            ->where('division', 'ml')
            ->get()
            ->result_array();

        $fifa_teams = $this->db->select('team, id')
            ->from('register')
            ->where('division', 'fifa')
            ->get()
            ->result_array();

        $ml_leaderboard = [];
        foreach ($ml_teams as $team) {
            $this->db->select_sum('points_a');
            $this->db->where('team_id_a', $team['id']);
            $this->db->where('division', 'ml');
            $points_for_team_a = $this->db->get('match_results')->row()->points_a;

            $this->db->select_sum('points_b');
            $this->db->where('team_id_b', $team['id']);
            $this->db->where('division', 'ml');
            $points_for_team_b = $this->db->get('match_results')->row()->points_b;

            $total_points = $points_for_team_a + $points_for_team_b;

            $matches_played = $this->db->where('division', 'ml')
                ->where('team_id_a', $team['id'])
                ->or_where('team_id_b', $team['id'])
                ->count_all_results('match_results');

            $wins = $this->db->where('division', 'ml')
                ->where('team_id_a', $team['id'])
                ->where('points_a > points_b')
                ->or_where('team_id_b', $team['id'])
                ->where('points_b > points_a')
                ->count_all_results('match_results');

            $losses = $matches_played - $wins;

            $ml_leaderboard[] = [
                'team' => $team['team'],
                'play' => $matches_played,
                'win' => $wins,
                'lose' => $losses,
                'points' => $total_points
            ];
        }

        usort($ml_leaderboard, function ($a, $b) {
            if ($a['win'] == $b['win']) {
                return $b['points'] - $a['points'];
            }
            return $b['win'] - $a['win'];
        });

        $rank = 1;
        foreach ($ml_leaderboard as $key => $team) {
            $ml_leaderboard[$key]['rank'] = $rank++;
        }

        $fifa_leaderboard = [];
        foreach ($fifa_teams as $team) {
            $this->db->select_sum('points_a');
            $this->db->where('team_id_a', $team['id']);
            $this->db->where('division', 'fifa');
            $points_for_team_a = $this->db->get('match_results')->row()->points_a;

            $this->db->select_sum('points_b');
            $this->db->where('team_id_b', $team['id']);
            $this->db->where('division', 'fifa');
            $points_for_team_b = $this->db->get('match_results')->row()->points_b;

            $total_points = $points_for_team_a + $points_for_team_b;

            $matches_played = $this->db->where('division', 'fifa')
                ->where('team_id_a', $team['id'])
                ->or_where('team_id_b', $team['id'])
                ->count_all_results('match_results');

            $wins = $this->db->where('division', 'fifa')
                ->where('team_id_a', $team['id'])
                ->where('points_a > points_b')
                ->or_where('team_id_b', $team['id'])
                ->where('points_b > points_a')
                ->count_all_results('match_results');

            $draws = $this->db->where('division', 'fifa')
                ->where('team_id_a', $team['id'])
                ->where('points_a = points_b')
                ->or_where('team_id_b', $team['id'])
                ->where('points_a = points_b')
                ->count_all_results('match_results');

            $losses = $matches_played - $wins - $draws;

            $fifa_leaderboard[] = [
                'team' => $team['team'],
                'play' => $matches_played,
                'win' => $wins,
                'lose' => $losses,
                'draw' => $draws,
                'points' => $total_points
            ];
        }

        usort($fifa_leaderboard, function ($a, $b) {
            if ($a['win'] == $b['win']) {
                return $b['points'] - $a['points'];
            }
            return $b['win'] - $a['win'];
        });

        $rank = 1;
        foreach ($fifa_leaderboard as $key => $team) {
            $fifa_leaderboard[$key]['rank'] = $rank++;
        }



        $data['ml_leaderboard'] = $ml_leaderboard;
        $data['fifa_leaderboard'] = $fifa_leaderboard;

        $this->load->view('dashboard', $data);
    }

    public function submit_registration()
    {
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

    public function submit_score()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $match_id = $this->input->post('match_title');
            $team_a_score = $this->input->post('team_1_score');
            $team_b_score = $this->input->post('team_2_score');
            $division = $this->input->post('division');

            list($team_a_id, $team_b_id) = explode('-', $match_id);

            $team_a = $this->db->get_where('register', ['id' => $team_a_id])->row_array();
            $team_b = $this->db->get_where('register', ['id' => $team_b_id])->row_array();

            $team_a_points = 0;
            $team_b_points = 0;

            if ($division === 'ml') {
                $team_a_points = $team_a_score;
                $team_b_points = $team_b_score;
            } else {
                if ($team_a_score > $team_b_score) {
                    $team_a_points = 3;
                    $team_b_points = 0;
                } elseif ($team_a_score < $team_b_score) {
                    $team_b_points = 3;
                    $team_a_points = 0;
                } else {
                    $team_a_points = 1;
                    $team_b_points = 1;
                }
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

                $match_title = $team_a['team'] . ' vs. ' . $team_b['team'];

                $match_result_data = [
                    'team_id_a' => $team_a_id,
                    'team_id_b' => $team_b_id,
                    'points_a' => $team_a_points,
                    'points_b' => $team_b_points,
                    'match_date' => date('Y-m-d H:i:s'),
                    'evidence_image' => $image_path,
                    'division' => $division,
                    'match_title' => $match_title
                ];

                $existing_match_result = $this->db->get_where('match_results', [
                    'team_id_a' => $team_a_id,
                    'team_id_b' => $team_b_id
                ])->row_array();

                if ($existing_match_result) {
                    $this->db->update('match_results', $match_result_data, [
                        'id' => $existing_match_result['id']
                    ]);
                } else {
                    $this->db->insert('match_results', $match_result_data);
                }

                $this->session->set_flashdata('success', 'Scores and evidence image uploaded successfully!');
            } else {
                $this->session->set_flashdata('error', 'Image upload failed: ' . $this->upload->display_errors());
            }

            redirect('uploadresult');
        }
    }
}
