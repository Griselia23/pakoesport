<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Dashboard_model'); // Load the model
    }

    // Display the registration form
    public function index() {
        $this->load->view('dashboard');
    }

    // Handle the form submission
    public function submit_registration() {
        // Get POST data
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

        // Save the data to the database
        if ($this->Dashboard_model->insert_team($data)) {
            // Redirect to a success page or back to the form
            $this->session->set_flashdata('success', 'Team registered successfully.');
            redirect('dashboard');
        } else {
            // Error saving data
            $this->session->set_flashdata('error', 'There was an error with the registration.');
            redirect('dashboard');
        }
    }


    //add the result controller here 
    public function submit_result() {
        // Load the necessary data
        $data['matches'] = $this->Dashboard_model->get_all_schedules(); // Get match data from the database
        $data['teams'] = $this->Dashboard_model->get_all_teams(); // Get teams data from the database
        
        $this->load->library('form_validation');
        
        // Validate form fields
        $this->form_validation->set_rules('match_number', 'Match', 'required');
        $this->form_validation->set_rules('team1', 'Team 1', 'required');
        $this->form_validation->set_rules('team2', 'Team 2', 'required');
        $this->form_validation->set_rules('score1', 'Score 1', 'required|numeric');
        $this->form_validation->set_rules('score2', 'Score 2', 'required|numeric');
        $this->form_validation->set_rules('evidence', 'Evidence', 'callback_file_check');
        
        if ($this->form_validation->run() === FALSE) {
            // If validation fails, load the view with data passed
            $this->load->view('upload_result_view', $data);
        } else {
            // Handle the form submission (this part remains as-is)
            $match_number = $this->input->post('match_number');
            $team1 = $this->input->post('team1');
            $team2 = $this->input->post('team2');
            $score1 = $this->input->post('score1');
            $score2 = $this->input->post('score2');
            $evidence = $this->upload_file();
    
            // Update match result in the database
            $this->Dashboard_model->update_result($match_number, $team1, $team2, $score1, $score2, $evidence);
    
            // Set a success message and redirect
            $this->session->set_flashdata('success', 'Result uploaded successfully!');
            redirect('dashboard');
        }
    }
    

    // File upload validation
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

    // Handle file upload for evidence
    private function upload_file() {
        if (isset($_FILES['evidence']) && $_FILES['evidence']['size'] > 0) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
            $config['max_size'] = 2048;  // Max file size 2MB
            $config['file_name'] = time() . '_' . $_FILES['evidence']['name'];

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('evidence')) {
                return $this->upload->data('file_name');
            } else {
                return '';  // Return an empty string if the upload fails
            }
        }
        return '';  // Return an empty string if no file is uploaded
    }

    

}
