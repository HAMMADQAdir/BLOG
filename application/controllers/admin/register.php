<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller
{
    public function index()
    {
        $this->load->view('adminPanel/registerView');
    }

    public function register_user()
    {
        $this->load->library('form_validation');
        $this->load->database(); 
        $this->load->library('session'); // Ensure session library is loaded

        // Validation Rules
        $this->form_validation->set_rules('name', 'Username', 'required|is_unique[user.name]');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run()) {
            $name = $this->input->post('name');
            $password = $this->input->post('password');

            // Insert Data
            $data = [
                'name' => $name,
                'password' => $password, // ideally, use password_hash($password, PASSWORD_DEFAULT)
                'created_at' => date('Y-m-d H:i:s')
            ];

            if ($this->db->insert('user', $data)) {
                
                // CRITICAL FIX: Log the user in immediately after registering
                $new_user_id = $this->db->insert_id();
                $this->session->set_userdata('user_id', $new_user_id);

                // Redirect to Dashboard
                return redirect('admin/article');
            } else {
                echo "Failed to add User.";
            }
        } else {
            // FIX: Load the Register view to show errors, not the Login view
            $this->load->view('adminPanel/registerView');
        }
    }
}