<?php
defined('BASEPATH') or exit('No direct script access allowed');

class About extends CI_Controller
{
    public function index()
    {
        $data['navbar'] = $this->load->view('template/navbar.php', NULL, TRUE);
		$data['css'] = $this->load->view('include/style.php', NULL, TRUE);
		$data['js'] = $this->load->view('include/script.php', NULL, TRUE);
		$data['footer'] = $this->load->view('template/footer.php', NULL, TRUE);
        $data['title'] = "About The Site";

        $this->load->view('pages/aboutSite/main.php', $data);
    }
}