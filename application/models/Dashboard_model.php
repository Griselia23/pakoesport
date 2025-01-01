<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Load the database
    }

    // Insert team registration data into the database
    public function insert_team($data) {
        return $this->db->insert('register', $data); // Assuming table name is 'register'
    }
}
