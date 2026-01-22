<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index() {
        // This loads the form shown above
        $this->load->view('adminPanel/loginView');
    }

  public function authenticate() {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');

    if ($this->form_validation->run()) {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $this->load->database();
        $user = $this->db->get_where('users', ['name' => $username])->row();

        if ($user && $user->password === $password) {
            // SET SESSION DATA
            $this->session->set_userdata('user_id', $user->id);
            
            // Redirect to the article page (or dashboard)
            return redirect('admin/addArticle');
        } else {
            echo "Invalid Username or Password";
        }
    } else {
        $this->load->view('adminPanel/loginView');
    }
}
}