<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
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
		$data['category'] = $this->categoryModel->getAllCategory();
		$data['posts'] = $this->newsModel->getPosts(0);
		$data['title'] = "Main Page";


		$this->load->view('pages/main/main.php', $data);
	}
	public function postPerCategory($id)
	{
		$data['navbar'] = $this->load->view('template/navbar.php', NULL, TRUE);
		$data['css'] = $this->load->view('include/style.php', NULL, TRUE);
		$data['js'] = $this->load->view('include/script.php', NULL, TRUE);
		$data['footer'] = $this->load->view('template/footer.php', NULL, TRUE);
		$data['category'] = $this->categoryModel->getAllCategory();
		$data['posts'] = $this->newsModel->getPosts($id);
		$data['title'] = $this->categoryModel->getCatName($id);

		$this->load->view('pages/main/main.php', $data);
	}

	public function details($id)
	{
		$data['navbar'] = $this->load->view('template/navbar.php', NULL, TRUE);
		$data['css'] = $this->load->view('include/style.php', NULL, TRUE);
		$data['js'] = $this->load->view('include/script.php', NULL, TRUE);
		$data['footer'] = $this->load->view('template/footer.php', NULL, TRUE);
		$data['title'] = $this->newsModel->getTitle($id);
		$data['content'] = $this->newsModel->getDetail($id);
		$data['comment'] = $this->commentModel->getCommentsPerPost($id);

		$this->load->view('pages/main/contentDetail.php', $data);
	}

	public function showAddForm()
	{
		$data['navbar'] = $this->load->view('template/navbar.php', NULL, TRUE);
		$data['css'] = $this->load->view('include/style.php', NULL, TRUE);
		$data['js'] = $this->load->view('include/script.php', NULL, TRUE);
		$data['footer'] = $this->load->view('template/footer.php', NULL, TRUE);
		$data['category'] = $this->categoryModel->getAllCategory();
		$data['title'] = "Add Post";
		$data['error'] = "";

		$this->load->view('pages/content/addPost.php', $data);
	}

	public function showEditForm($id)
	{
		$data['id'] = $id;
		$data['navbar'] = $this->load->view('template/navbar.php', NULL, TRUE);
		$data['css'] = $this->load->view('include/style.php', NULL, TRUE);
		$data['js'] = $this->load->view('include/script.php', NULL, TRUE);
		$data['footer'] = $this->load->view('template/footer.php', NULL, TRUE);
		$data['category'] = $this->categoryModel->getAllCategory();
		$data['title'] = "Edit Post";
		$data['error'] = "";
		$data['content'] = $this->newsModel->getDetail($id);

		$this->load->view('pages/content/editPost.php', $data);
	}

	public function addPost()
	{
		$form_validate = array(
			array(
				'field' => 'title',
				'label' => 'Post Title:',
				'rules' => 'required|callback_checkPostIsExist',
				'errors' => array(
					'is_unique' => 'This post is already exist in this system! Please check your input'
				)
			)
		);
		$this->form_validation->set_rules($form_validate);

		$data['navbar'] = $this->load->view('template/navbar.php', NULL, TRUE);
		$data['css'] = $this->load->view('include/style.php', NULL, TRUE);
		$data['js'] = $this->load->view('include/script.php', NULL, TRUE);
		$data['footer'] = $this->load->view('template/footer.php', NULL, TRUE);
		$data['category'] = $this->categoryModel->getAllCategory();
		$data['title'] = "Add Post";
		$data['error'] = "";

		if ($this->form_validation->run() == false) {
			$this->load->view('pages/content/addPost.php', $data);
		} else {
			$postTitle = $this->input->post('title');
			$postAuthor = $this->input->post('author');
			$postContent = $this->input->post('content');
			$categoryId = $this->input->post('category');
			$date = $this->input->post('date');

			$title = $this->db->escape($postTitle);
			$author = $this->db->escape($postAuthor);
			$content = $this->db->escape($postContent);
			$config['upload_path'] = './assets/postAssets/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size'] = 100000;
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('image')) {
				$data['error'] = $this->upload->display_errors();
			} else {
				$uploadData = $this->upload->data();
				$imageLink = $uploadData['file_name'];
				$this->newsModel->addPost($title, $author, $date, $categoryId, $content, $imageLink);
				redirect(base_url('Main'));
			}
		}
	}

	public function checkPostIsExist($title)
	{
		$title = $this->newsModel->checkPostIsExist($title)->row();

		if (!empty($title)) {
			$this->form_validation->set_message('checkPostIsExist', 'This post is already exist in this system! Please check your input');
			return FALSE;
		}
		return TRUE;
	}

	public function editPost($id)
	{
		$postTitle = $this->input->post('title');
		$postAuthor = $this->input->post('author');
		$postContent = $this->input->post('content');
		$categoryId = $this->input->post('category');
		$date = $this->input->post('date');

		$title = $this->db->escape($postTitle);
		$author = $this->db->escape($postAuthor);
		$content = $this->db->escape($postContent);
		$config['upload_path'] = './assets/postAssets/';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size'] = 100000;
		$this->load->library('upload', $config);

		if (!is_uploaded_file($_FILES['image']['tmp_name'])) {
			$imageLink = $this->input->post('old_image');
			$this->newsModel->updatePost($id, $title, $author, $date, $categoryId, $content, $imageLink);
			redirect(base_url('Main'));
		} else {
			if (!$this->upload->do_upload('image')) {
				echo $this->upload->display_errors();
			} else {
				$uploadData = $this->upload->data();
				$imageLink = $uploadData['file_name'];
				$this->newsModel->updatePost($id, $title, $author, $date, $categoryId, $content, $imageLink);
				redirect(base_url('Main'));
			}
		}
	}

	public function deletePost($id)
	{
		$this->newsModel->deletePost($id);
		redirect("Main");
	}
}
