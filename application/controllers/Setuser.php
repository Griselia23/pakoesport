<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setuser extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Dashboard_model'); 
    }

    // Load users and display on the main page
    public function index() {
        // Retrieve all users from the model
        $data['users'] = $this->Dashboard_model->get_all_user();

        // Check if there's a flash message for any action
        if ($this->session->flashdata('message')) {
            $data['message'] = $this->session->flashdata('message');
        }

        // Pass the data to the view
        $this->load->view('setuser', $data);
    }

    // Add a new user
    public function add_user() {
        if ($this->input->post()) {
            $data = array(
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'npk' => $this->input->post('npk')
            );
            $this->Dashboard_model->add_user($data);

            // Set a session flash message for SweetAlert
            $this->session->set_flashdata('message', 'User successfully added!');
            redirect('setuser');  // Reload the page after adding
        }
    }

    // Edit an existing user
    public function edit_user($id = null) {
        if ($id) {
            // Retrieve user data by ID
            $data['user'] = $this->Dashboard_model->get_user_by_id($id);
            
            if ($this->input->post()) {
                // Get data from the POST request
                $data_update = array(
                    'username' => $this->input->post('username'),
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'npk' => $this->input->post('npk')
                );
                // Update the user in the database
                $this->Dashboard_model->update_user($id, $data_update);

                // Set a session flash message for SweetAlert
                $this->session->set_flashdata('message', 'User successfully updated!');
                redirect('setuser');  // Reload the page after updating
            }

            // Load the view with the user data
            $this->load->view('setuser', $data);
        }
    }

    // Delete a user
    public function delete_user($id) {
        $this->Dashboard_model->delete_user($id);

        // Set a session flash message for SweetAlert
        $this->session->set_flashdata('message', 'User successfully deleted!');
        redirect('setuser');
    }
}
