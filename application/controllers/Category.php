<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('categoryModel');
		$this->load->library('form_validation');
	}
	public function index()
	{
		$data['id'] = "";
		$data['navbar'] = $this->load->view('template/navbar.php', NULL, TRUE);
		$data['css'] = $this->load->view('include/style.php', NULL, TRUE);
		$data['js'] = $this->load->view('include/script.php', NULL, TRUE);
		$data['footer'] = $this->load->view('template/footer.php', NULL, TRUE);
		$data['category'] = $this->categoryModel->getAllCategory();
		$data['title'] = "Category Lists";
		$data['error'] = "";
		$data['modal'] = "";

		$this->load->view('pages/category/main.php', $data);
	}

	public function addCategory()
	{
		$form_validate = array(
			array(
				'field' => 'category',
				'label' => 'Category Name:',
				'rules' => 'required|callback_checkCatIsExist',
				'errors' => array(
					'is_unique' => 'This category is already exist in this system! Please check your input'
				)
			)
		);

		$this->form_validation->set_rules($form_validate);


		$data['id'] = "";
		$data['navbar'] = $this->load->view('template/navbar.php', NULL, TRUE);
		$data['css'] = $this->load->view('include/style.php', NULL, TRUE);
		$data['js'] = $this->load->view('include/script.php', NULL, TRUE);
		$data['footer'] = $this->load->view('template/footer.php', NULL, TRUE);
		$data['category'] = $this->categoryModel->getAllCategory();
		$data['title'] = "Category Lists";
		$data['error'] = "";


		if ($this->form_validation->run() == false) {
			$data['modal'] = "
			<script>
				$(window).on('load', function() {
					$('#add').modal('show');
				});
			</script>
			";
			$this->load->view('pages/category/main.php', $data);
		} else {
			$postName = $this->input->post('category');
			$name = $this->db->escape($postName);

			$this->categoryModel->addCategory($name);
			redirect(base_url('Category'));
		}
	}

	public function checkCatIsExist($name)
	{
		$title = $this->categoryModel->checkCatIsExist($name)->row();

		if (!empty($title)) {
			$this->form_validation->set_message('checkCatIsExist', 'This category is already exist in this system! Please check your input');
			return FALSE;
		}
		return TRUE;
	}

	public function showEditForm($id)
	{
		$data['id'] = $id;
		$data['navbar'] = $this->load->view('template/navbar.php', NULL, TRUE);
		$data['css'] = $this->load->view('include/style.php', NULL, TRUE);
		$data['js'] = $this->load->view('include/script.php', NULL, TRUE);
		$data['footer'] = $this->load->view('template/footer.php', NULL, TRUE);
		$data['category'] = $this->categoryModel->getAllCategory();
		$data['categoryName'] = $this->categoryModel->detail($id);
		$data['title'] = "Category Lists";
		$data['error'] = "";
		$data['modal'] = "
		<script>
			$(window).on('load', function() {
				$('#edit').modal('show');
			});
		</script>
		";

		$this->load->view('pages/category/main.php', $data);
	}


	public function editCategory($id)
	{
		$form_validate = array(
			array(
				'field' => 'category',
				'label' => 'Category Name:',
				'rules' => 'required'
			)
		);

		$this->form_validation->set_rules($form_validate);


		$data['navbar'] = $this->load->view('template/navbar.php', NULL, TRUE);
		$data['css'] = $this->load->view('include/style.php', NULL, TRUE);
		$data['js'] = $this->load->view('include/script.php', NULL, TRUE);
		$data['footer'] = $this->load->view('template/footer.php', NULL, TRUE);
		$data['category'] = $this->categoryModel->getAllCategory();
		$data['categoryName'] = $this->categoryModel->detail($id);
		$data['title'] = "Category Lists";
		$data['error'] = "";


		if ($this->form_validation->run() == false) {
			$data['modal'] = "
			<script>
				$(window).on('load', function() {
					$('#edit').modal('show');
				});
			</script>
			";
			$this->load->view('pages/category/main.php', $data);
		} else {
			$postName = $this->input->post('category');
			$name = $this->db->escape($postName);

			$this->categoryModel->editCategory($id, $name);
			redirect(base_url('Category'));
		}
	}

	public function deleteCategory($id)
	{
		$this->categoryModel->deleteCategory($id);
		redirect("Category");
	}
}
