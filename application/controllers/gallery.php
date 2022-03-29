<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends CI_Controller {
	var $title = "Gallery";

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('url','html');
		$this->load->model('m_barang');
		if (!$this->session->userdata('level')) {
			redirect('login');
		}

	}
	public function index()
	{
		$title = $this->title;
		$data = $this->m_barang->data_barang();
		$this->load->view('gallery/gallery',['title'=>$title,'data'=>$data]);
	}

}

/* End of file gallery.php */
/* Location: ./application/controllers/gallery.php */