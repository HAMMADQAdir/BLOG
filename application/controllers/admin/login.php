<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function index()
    {
        // This loads the form shown above
        $this->load->view('adminPanel/loginView');
    }

    public function authenticate()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run()) {
            $name = $this->input->post('name');
            $password = $this->input->post('password');

            $this->load->database();
            $user = $this->db->get_where('user', ['name' => $name])->row();

            if ($user && $user->password === $password) {
                // SET SESSION DATA
                $this->session->set_userdata('user_id', $user->id);

                // Redirect to the article page (or dashboard)
                return redirect('admin/article');
            } else {
                echo "Invalid Username or Password";
            }
        } else {
            $this->load->view('adminPanel/loginView');
        }


    }

    public function logout()
    {
        // Remove the user_id from session
        $this->session->unset_userdata('user_id');

        // Redirect to Login Page
        return redirect('admin/login');
    }
}