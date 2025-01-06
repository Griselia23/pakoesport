<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Ensure the database is loaded using CI's built-in method
    }

    public function get_schedules_with_teams($division = NULL, $sections = 1) {
    

}
}