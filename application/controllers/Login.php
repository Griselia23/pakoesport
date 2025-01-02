<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->database();
    }

    public function index() {
        $this->load->view('login');
    }

    public function authenticate() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
    
        $user = $this->db->get_where('user', ['username' => $username])->row();
    
        if ($user && password_verify($password, $user->password)) {
            $this->session->set_userdata('user_id', $user->id);
            $this->session->set_userdata('username', $user->username);
    
            $this->session->set_flashdata('success', 'Login successful! Welcome, ' . $user->username . '.');
            redirect('admin'); // redirects to admin controller
        } else {
            $this->session->set_flashdata('error', 'Invalid username or password!');
            redirect('login'); // redirects back to login
        }
    }
    

    public function logout() {
        $this->session->sess_destroy();
        redirect('dashboard');
    }
}
