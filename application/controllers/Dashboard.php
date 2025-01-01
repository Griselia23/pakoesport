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
}
