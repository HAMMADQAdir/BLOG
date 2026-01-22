<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->database(); 
        $this->load->helper('url'); 

        if (!$this->session->userdata('user_id')) {
            return redirect('admin/login');
        }
    }

    // 1. DASHBOARD: Fetch and Display All Articles
    // 1. DASHBOARD: Fetch and Display Articles for Current User Only
    public function index() {
        // Get the logged-in User's ID from the session
        $user_id = $this->session->userdata('user_id');

        // Fetch rows from 'article' table WHERE user_id matches the session ID
        // Query equivalent: SELECT * FROM article WHERE user_id = $user_id
        $articles = $this->db->get_where('article', ['user_id' => $user_id])->result(); 
        
        // Load the dashboard view and pass the filtered data
        $this->load->view('adminPanel/dashboard', ['articles' => $articles]);
    }

    // 2. NEW PAGE: Show the Add Article Form
    public function add_view() {
        $this->load->view('adminPanel/addArticleView');
    }

    // 3. LOGIC: Handle the Form Submission
    public function add_article() {
        $this->form_validation->set_rules('article_name', 'article_name', 'required');
        $this->form_validation->set_rules('body', 'body', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('adminPanel/addArticleView');
        } else {
            $data = [
                'article_name' => $this->input->post('article_name'),
                'body'  => $this->input->post('body'),
                'user_id'       => $this->session->userdata('user_id'),
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            ];

            if ($this->db->insert('article', $data)) {
                // Redirect back to the dashboard after adding
                return redirect('admin/article');
            } else {
                echo "Failed to add article.";
            }
        }
    }

    // ... inside class Article ...

    // ----------------------------------------------------------------
    // DELETE FUNCTIONALITY
    // ----------------------------------------------------------------
    public function delete_article($id) {
        // Delete the row where 'id' matches the $id passed in the URL
        $this->db->delete('article', ['id' => $id]);
        return redirect('admin/article');
    }

    // ----------------------------------------------------------------
    // EDIT FUNCTIONALITY - STEP 1: Show the form
    // ----------------------------------------------------------------
    public function edit_article($id) {
        // 1. Fetch the specific article data
        $article = $this->db->get_where('article', ['id' => $id])->row();

        // 2. Check if article exists
        if (!$article) {
            echo "Article not found!";
            exit; // Or redirect
        }

        // 3. Load the edit view and pass the data
        $this->load->view('adminPanel/editArticleView', ['article' => $article]);
    }

    // ----------------------------------------------------------------
    // EDIT FUNCTIONALITY - STEP 2: Handle the Update
    // ----------------------------------------------------------------
    public function update_article($id) {
        $this->form_validation->set_rules('article_name', 'Article Name', 'required');
        $this->form_validation->set_rules('body', 'Article Body', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Validation failed? Show the form again with the ID
            // We need to fetch the article again to repopulate the form
            $article = $this->db->get_where('article', ['id' => $id])->row();
            $this->load->view('adminPanel/editArticleView', ['article' => $article]);
        } else {
            // Prepare Data for Update
            $data = [
                'article_name' => $this->input->post('article_name'),
                'body'         => $this->input->post('body'),
                // We typically update 'updated_at' here
                'updated_at'   => date('Y-m-d H:i:s')
            ];

            // Perform Update Query
            $this->db->where('id', $id);
            if ($this->db->update('article', $data)) {
                return redirect('admin/article');
            } else {
                echo "Failed to update article.";
            }
        }
    }
}