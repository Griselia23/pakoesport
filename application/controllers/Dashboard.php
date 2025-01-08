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
        $this->load->view('dashboard');
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

    public function submit_result() {
        $data['matches'] = $this->Dashboard_model->get_all_schedules();
        $data['teams'] = $this->Dashboard_model->get_all_teams();
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('match_number', 'Match', 'required');
        $this->form_validation->set_rules('team1', 'Team 1', 'required');
        $this->form_validation->set_rules('team2', 'Team 2', 'required');
        $this->form_validation->set_rules('score1', 'Score 1', 'required|numeric');
        $this->form_validation->set_rules('score2', 'Score 2', 'required|numeric');
        $this->form_validation->set_rules('evidence', 'Evidence', 'callback_file_check');
        
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('upload_result_view', $data);
        } else {
            $match_number = $this->input->post('match_number');
            $team1 = $this->input->post('team1');
            $team2 = $this->input->post('team2');
            $score1 = $this->input->post('score1');
            $score2 = $this->input->post('score2');
            $evidence = $this->upload_file();
    
            $this->Dashboard_model->update_result($match_number, $team1, $team2, $score1, $score2, $evidence);
    
            $this->session->set_flashdata('success', 'Result uploaded successfully!');
            redirect('dashboard');
        }
    }

    public function file_check($str) {
        if (isset($_FILES['evidence']) && $_FILES['evidence']['size'] > 0) {
            $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'pdf'];
            $file_ext = pathinfo($_FILES['evidence']['name'], PATHINFO_EXTENSION);
            
            if (!in_array($file_ext, $allowed_types)) {
                $this->form_validation->set_message('file_check', 'Please upload a valid file (jpg, jpeg, png, gif, pdf).');
                return FALSE;
            }
        }
        return TRUE;
    }

    private function upload_file() {
        if (isset($_FILES['evidence']) && $_FILES['evidence']['size'] > 0) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
            $config['max_size'] = 2048;
            $config['file_name'] = time() . '_' . $_FILES['evidence']['name'];

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('evidence')) {
                return $this->upload->data('file_name');
            } else {
                return '';
            }
        }
        return '';
    }

    public function schedule() {
        $matches = $this->Admin_model->matchmaking();

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
}
