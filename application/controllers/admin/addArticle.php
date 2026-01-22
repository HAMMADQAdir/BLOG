<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->helper('url');

        // SECURITY CHECK
        // If 'user_id' is not in session, they are not logged in.
        if (!$this->session->userdata('user_id')) {
            return redirect('admin/login');
        }
    }

    public function index()
    {
        $this->load->view('adminPanel/addArticleView');
    }

    public function add_article()
    {
        // 1. Validation Rules
        $this->form_validation->set_rules('article_title', 'Article Title', 'required');
        $this->form_validation->set_rules('article_body', 'Article Body', 'required');

        if ($this->form_validation->run() == FALSE) {
            // If validation fails, reload the form with errors
            $this->load->view('adminPanel/addArticleView');
        } else {
            // 2. Prepare Data for Insertion
            $data = [
                'article_title' => $this->input->post('article_title'),
                'article_body' => $this->input->post('article_body'),
                'user_id' => 1 // Hardcoded for now. Later, use: $this->session->userdata('user_id')
            ];

            // 3. Insert into Database
            if ($this->db->insert('articles', $data)) {
                echo "Article Added Successfully!";
            } else {
                echo "Failed to add article.";
            }
        }
    }
}