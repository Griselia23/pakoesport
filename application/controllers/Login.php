<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->database();

        // if($this->session->userdata('pakoesport') == null){
        //     redirect('login');
        // }
    }

    public function index() {
        $this->load->view('login');
    }

    public function authenticate() {
        $npk = $this->input->post('npk');
        $password = $this->input->post('password');
        
        $register = $this->db->get_where('register', ['npk' => $npk])->row();
        
        log_message('debug', 'Register Query Result: ' . print_r($register, true));
        
        if ($register && password_verify($password, $register->password)) {
            $this->session->set_userdata('user_id', $register->id);
            $this->session->set_userdata('role', 'member'); 
            $this->session->set_flashdata('success', 'Login successful! Welcome, ' . $register->npk . '.');
            redirect('uploadresult');
        }
    
        $user = $this->db->get_where('user', ['npk' => $npk])->row();
        
        if ($user && password_verify($password, $user->password)) {
            $this->session->set_userdata('user_id', $user->id);
            $this->session->set_userdata('role', 'admin'); 
            $this->session->set_flashdata('success', 'Login successful! Welcome, ' . $user->npk . '.');
            redirect('admin');
        }
    
        $this->session->set_flashdata('error', 'Invalid NPK or password!');
        redirect('login');
    }    
    
    public function logout() {
        $this->session->sess_destroy();
        $this->session->set_flashdata('success', 'You have logged out successfully.');
        redirect('#home');
    }
}
