<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Comment extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->load->model('newsModel');
		$this->load->model('categoryModel');
		$this->load->model('commentModel');
		$this->load->library('form_validation');
	}

    public function index()
    {
        $data['navbar'] = $this->load->view('template/navbar.php', NULL, TRUE);
		$data['css'] = $this->load->view('include/style.php', NULL, TRUE);
		$data['js'] = $this->load->view('include/script.php', NULL, TRUE);
		$data['footer'] = $this->load->view('template/footer.php', NULL, TRUE);
        $data['comment'] = $this->commentModel->getCommentList();
		$data['title'] = "Comment List";

        $this->load->view('pages/comment/main.php', $data);
    }

	public function deleteComment($id)
	{
		$this->commentModel->deleteComment($id);
		redirect("Comment");
	}
}