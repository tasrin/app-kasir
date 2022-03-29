<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tentang extends CI_Controller {

	var $title = "Tentang Aplikasi";
	public function index()
	{
		if($this->session->userdata('level') == 'admin') 
        {
            return redirect('admin');
        }
        elseif ($this->session->userdata('level') == 'kasir') {
        	redirect('transaksi','refresh');
        }
		$title = $this->title;
		$this->load->view('tentang',['title'=>$title]);
	}

}

/* End of file tentang.php */
/* Location: ./application/controllers/tentang.php */