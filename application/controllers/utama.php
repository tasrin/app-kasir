<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utama extends CI_Controller {
	var $title = "Halaman Utama";


	public function index()
	{
		if ($this->session->userdata('level')) {
			redirect('admin');
		}	
		$title = $this->title;
		$this->load->view('utama',['title'=>$title]);
	}

}

/* End of file utama.php */
/* Location: ./application/controllers/utama.php */