<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends Ci_Controller {


	var $title = "Halaman Admin";
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('url','html');
		$this->load->model('m_barang');
		if (!$this->session->userdata('level')) {
			redirect('login');
		}
		elseif ($this->session->userdata('level') == 'kasir') {
			redirect('transaksi');
		}
	}

	public function index()
	{	
		$title = $this->title;
		$this->load->view('admin/admin',['title'=>$title]);
	}

}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */