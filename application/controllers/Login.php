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
        $npk = $this->input->post('npk');
        $password = $this->input->post('password');
    
        $user = $this->db->get_where('user', ['npk' => $npk])->row();
    
        if ($user && password_verify($password, $user->password)) {
            $this->session->set_userdata('user_id', $user->id);
            $this->session->set_userdata('username', $user->username);
    
            $this->session->set_flashdata('success', 'Login successful! Welcome, ' . $user->npk . '.');
            redirect('admin');
        } else {
            $this->session->set_flashdata('error', 'Invalid npk or password!');
            redirect('login');
        }
    }
    
    public function logout() {
        $this->session->sess_destroy();
        $this->session->set_flashdata('success', 'You have logged out successfully.');
        redirect('#home');
    }
}
