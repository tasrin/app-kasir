<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir extends CI_Controller {

	var $title = "Kasir";
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('url','html');
		$this->load->model('m_kasir');
		if (!$this->session->userdata('level')) {
			redirect('login');
		}
	}

	public function index()
	{
		$this->data_kasir();	
	}

	public function data_kasir()
	{
		$data = $this->m_kasir->data_kasir();
	    $title = $this->title;
	    $this->load->view('kasir/data_kasir',['title'=>$title,'data'=>$data]);
	}

	public function add_kasir()
	{
		$this->form_validation->set_rules('nama_kasir', 'Nama kasir', 'required|max_length[30]');
		$this->form_validation->set_rules('no_telepon', 'No telepon','required|numeric');
		$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		$this->load->library('upload');
		$nmfile = "foto_kasir_".time(); //nama file saya beri nama langsung dan diikuti fungsi time
		$config['upload_path'] = './images/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
		$config['max_size'] = '2048'; //maksimum besar file 2M
		$config['max_width']  = '2288'; //lebar maksimum 1288 px
		$config['max_height']  = '1768'; //tinggi maksimu 768 px
		$config['file_name'] = $nmfile; //nama yang terupload nantinya

		$this->upload->initialize($config);
		if($_FILES['foto']['name'])
		{

			if ($this->form_validation->run() && $this->upload->do_upload('foto'))
			{
				 // mahasiswa
				$nama_kasir         =   $this->input->post('nama_kasir');
				$no_telepon       =   $this->input->post('no_telepon');
				$jk      =   $this->input->post('jk');
				$alamat      =   $this->input->post('alamat');

				$gbr = $this->upload->data();
				$kasir         =   array( 'nama_kasir'=>$nama_kasir,
				                            'no_telepon'=>$no_telepon,
				                            'jk'=>$jk,
				                            'alamat'=>$alamat,
				                            'foto'=>$gbr['file_name']);

				$data =array_merge($kasir);
				if ($this->m_kasir->tambah_kasir($data))
				{
				  $this->session->set_flashdata('kasir_add', "Data ". strtoupper($nama_kasir) ." Sudah Tersimpan Di Batabase");
				}
				return redirect('kasir/');

			}
			else
			{
				$error = array('error' => $this->upload->display_errors());
				$this->index();
			}

		}
		else
		{ 
			/* jika file foto tidak ada maka query yg dijalankan adalah skrip ini  */
			if ($this->form_validation->run())
			{
				$nama_kasir    =   $this->input->post('nama_kasir');
				$no_telepon    =   $this->input->post('no_telepon');
				$jk     	   =   $this->input->post('jk');
				$alamat        =   $this->input->post('alamat');

				$gbr		   =   $this->upload->data();
				$kasir         =   array( 'nama_kasir'=>$nama_kasir,
				                            'no_telepon'=>$no_telepon,
				                            'jk'=>$jk,
				                            'alamat'=>$alamat
				                       	);

				$data =array_merge($kasir);
				if ($this->m_kasir->tambah_kasir($data))
				{
				  $this->session->set_flashdata('kasir_add', "Data ". strtoupper($nama_kasir) ." Sudah Tersimpan Di Batabase");
				}
				return redirect('kasir/');
			}
			else
			{
			    $this->index();
			}

		}
	}

	public function Edit_kasir($id_kasir)
	{
		$data = $this->m_kasir->ambil_data_kasir($id_kasir);
	    $title = $this->title;
	    $this->load->view('kasir/edit_kasir',['title'=>$title,'data'=>$data]);
	}

	public function update_kasir()
	{
		$this->form_validation->set_rules('nama_kasir', 'Nama kasir', 'required|max_length[30]');
		$this->form_validation->set_rules('no_telepon', 'No telepon','required|numeric');
		$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		$this->load->library('upload');
		$nmfile = "foto_kasir_".time(); //nama file saya beri nama langsung dan diikuti fungsi time
		$config['upload_path'] = './images/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
		$config['max_size'] = '2048'; //maksimum besar file 2M
		$config['max_width']  = '2288'; //lebar maksimum 1288 px
		$config['max_height']  = '1768'; //tinggi maksimu 768 px
		$config['file_name'] = $nmfile; //nama yang terupload nantinya
		$id_kasir = $this->input->post('id_kasir');
		$this->upload->initialize($config);
		if($_FILES['foto']['name'])
		{

			if ($this->form_validation->run() && $this->upload->do_upload('foto'))
			{
				 // mahasiswa
				$nama_kasir         =   $this->input->post('nama_kasir');
				$no_telepon       =   $this->input->post('no_telepon');
				$jk      =   $this->input->post('jk');
				$alamat      =   $this->input->post('alamat');

				$gbr = $this->upload->data();
				$kasir         =   array( 'nama_kasir'=>$nama_kasir,
				                            'no_telepon'=>$no_telepon,
				                            'jk'=>$jk,
				                            'alamat'=>$alamat,
				                            'foto'=>$gbr['file_name']);
				$where = array('id_kasir' => $id_kasir);
				$data =array_merge($kasir);
				if ($this->m_kasir->update_kasir($data,$where))
				{
				  $this->session->set_flashdata('kasir_edit', "Data ". strtoupper($nama_kasir) ."Berhasil Di Edit");
				}
				return redirect('kasir/');

			}
			else
			{
				$error = array('error' => $this->upload->display_errors());
				$this->index();
			}

		}
		else
		{ 
			/* jika file foto tidak ada maka query yg dijalankan adalah skrip ini  */
			if ($this->form_validation->run())
			{
				$nama_kasir    =   $this->input->post('nama_kasir');
				$no_telepon    =   $this->input->post('no_telepon');
				$jk     	   =   $this->input->post('jk');
				$alamat        =   $this->input->post('alamat');

				$gbr		   =   $this->upload->data();
				$kasir         =   array( 'nama_kasir'=>$nama_kasir,
				                            'no_telepon'=>$no_telepon,
				                            'jk'=>$jk,
				                            'alamat'=>$alamat
				                       	);

				$where = array('id_kasir' => $id_kasir);
				$data =array_merge($kasir);
				if ($this->m_kasir->update_kasir($data,$where))
				{
				  $this->session->set_flashdata('kasir_edit', "Data ". strtoupper($nama_kasir) ."Berhasil Di Edit");
				}
				return redirect('kasir/');
			}
			else
			{
			    $this->index();
			}

		}
	}

	public function delete_kasir($where)
	{
		$path= './images/';
		$rowdel = $this->m_kasir->get_byimage($where);
		@unlink($path.$rowdel->foto);
		if ( $this->m_kasir->delete_kasir($where))
		{
		  $this->session->set_flashdata('kasir_delete', "Data Berhasil di hapus");
		}
		return redirect('kasir');
	} 


}

/* End of file kasir.php */
/* Location: ./application/controllers/kasir.php */