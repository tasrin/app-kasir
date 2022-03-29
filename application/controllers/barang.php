<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {
	
	var $title = "Barang";
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
		$this->data_barang();	
	}

	public function tambah_barang()
	{
		$level = $this->session->userdata('level');
		if($level == 'admin' OR $level == 'kasir' OR $level == 'keuangan')
		{
			if($_POST)
			{
				$this->load->library('form_validation');
				$this->form_validation->set_rules('kd_barang', 'Kode Barang', 'required|is_unique[tb_barang.kd_barang]|max_length[15]|numeric');
				$this->form_validation->set_rules('nama_barang', 'Nama Barang','required');
				$this->form_validation->set_rules('jumlah_barang', 'Nama Barang','required|numeric');
				$this->form_validation->set_rules('harga_satuan', 'Harga Satuan', 'required|numeric');

				$this->form_validation->set_message('alpha_spaces','%s harus alphabet !');
				$this->form_validation->set_message('numeric','%s harus angka !');
				$this->form_validation->set_message('required','%s harus diisi !');

				// $this->load->library('upload');
				// $nmfile = "file_".time(); //nama file saya beri nama langsung dan diikuti fungsi time
				// $config['upload_path'] = './images/'; //path folder
				// $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
				// $config['max_size'] = '2048'; //maksimum besar file 2M
				// $config['max_width']  = '2288'; //lebar maksimum 1288 px
				// $config['max_height']  = '1768'; //tinggi maksimu 768 px
				// $config['file_name'] = $nmfile; //nama yang terupload nantinya

				// $this->upload->initialize($config);
				// if($_FILES['foto']['name'])
				// {
					if($this->form_validation->run() == TRUE)
					{
						$kd_barang         =   $this->input->post('kd_barang');
						$nama_barang       =   $this->input->post('nama_barang');
						$jumlah_barang       =   $this->input->post('jumlah_barang');
						$harga_satuan      =   $this->input->post('harga_satuan');

						$barang         =   array( 'kd_barang'=>$kd_barang,
						                            'nama_barang'=>$nama_barang,
						                            'jumlah_barang'=>$jumlah_barang,
						                            'harga_satuan'=>$harga_satuan
						                        );
						                           

						$data =array_merge($barang);
						$insert 	= $this->m_barang->tambah_barang($data);
						if($insert)
						{
							echo json_encode(array(
								'status' => 1,
								'pesan' => "<div class='alert alert-success'><i class='fa fa-check'></i> <b>".$nama_barang."</b> berhasil ditambahkan sebagai pelanggan.</div>"
					
							));
						}
						else
						{
							$this->query_error();
						}
					}
					else
					{
						$this->input_error();
					}
				// }
				// else
				// {

				// 	if($this->form_validation->run() == TRUE)
				// 	{
				// 		$this->load->model('m_pelanggan');
				// 		$nama 		= $this->input->post('kd_barang');
						

				// 		$unique		= time().$this->session->userdata('id_kasir');
				// 		$insert 	= $this->m_pelanggan->tambah_pelanggan($nama, $alamat, $telepon, $info, $unique);
				// 		if($insert)
				// 		{
				// 			$id_pelanggan = $this->m_pelanggan->get_dari_kode($unique)->row()->id_pelanggan;
				// 			echo json_encode(array(
				// 				'status' => 1,
				// 				'pesan' => "<div class='alert alert-success'><i class='fa fa-check'></i> <b>".$nama."</b> berhasil ditambahkan sebagai pelanggan.</div>",
				// 				'id_pelanggan' => $id_pelanggan,
				// 				'nama' => $nama,
				// 				'alamat' => preg_replace("/\r\n|\r|\n/",'<br />', $alamat),
				// 				'telepon' => $telepon,
				// 				'info' => (empty($info)) ? "<small><i>Tidak ada</i></small>" : preg_replace("/\r\n|\r|\n/",'<br />', $info)						
				// 			));
				// 		}
				// 		else
				// 		{
				// 			$this->query_error();
				// 		}
				// 	}
				// 	else
				// 	{
				// 		$this->input_error();
				// 	}
				// }
			}
			else
			{
				$this->load->view('barang/tambah_barang');
			}
		}
	}

	public function data_barang()
	{
		$sum_harga   = $this->m_barang->sum_harga_satuan();
		$sum_jumlah   = $this->m_barang->sum_jumlah_barang();
		$data  = $this->m_barang->data_barang();
	    $title = $this->title;
	    $this->load->view('barang/data_barang',['title'=>$title,'data'=>$data,'sum_harga'=>$sum_harga,'sum_jumlah'=>$sum_jumlah]);
	}


	public function add_barang()
	{
		if ($_POST) 
		{
			$this->form_validation->set_rules('kd_barang', 'Kode Barang', 'required|is_unique[tb_barang.kd_barang]|max_length[15]');
		$this->form_validation->set_rules('nama_barang', 'Nama Barang','required');
		$this->form_validation->set_rules('jumlah_barang', 'Nama Barang','required|numeric');
		$this->form_validation->set_rules('harga_satuan', 'Harga Satuan', 'required|numeric');
		// $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		$this->form_validation->set_message('alpha_spaces','%s harus alphabet !');
				$this->form_validation->set_message('numeric','%s harus angka !');
				$this->form_validation->set_message('required','%s harus diisi !');
		$this->load->library('upload');
		$nmfile = "file_".time(); //nama file saya beri nama langsung dan diikuti fungsi time
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
				$kd_barang         =   $this->input->post('kd_barang');
				$nama_barang       =   $this->input->post('nama_barang');
				$jumlah_barang       =   $this->input->post('jumlah_barang');
				$harga_satuan      =   $this->input->post('harga_satuan');
				$foto              =   $this->input->post('foto'); 
				$gbr = $this->upload->data();
				$barang         =   array( 'kd_barang'=>$kd_barang,
				                            'nama_barang'=>$nama_barang,
				                            'jumlah_barang'=>$jumlah_barang,
				                            'harga_satuan'=>$harga_satuan,
				                            'foto'=>$gbr['file_name']);

				$data =array_merge($barang);
				if ($this->m_barang->tambah_barang($data))
				{
				  $this->session->set_flashdata('barang_add', "Data ". strtoupper($kd_barang) ." Sudah Tersimpan Di Batabase");
				}
				return redirect('barang/');

			}
			else
			{
				$error = array('error' => $this->upload->display_errors());
				$this->index();
			}

		}
		else
		{ /* jika file foto tidak ada maka query yg dijalankan adalah skrip ini  */
			if ($this->form_validation->run())
			{
				$kd_barang          = $this->input->post('kd_barang');
				$nama_barang        = $this->input->post('nama_barang');
				$jumlah_barang        = $this->input->post('jumlah_barang');
				$barang = array(
								'kd_barang'     => $kd_barang,
								'nama_barang'   => $nama_barang,
								'jumlah_barang'   => $jumlah_barang,
								'harga_satuan'  => $this->input->post('harga_satuan'));

				$data =array_merge($barang);
				if ($this->m_barang->tambah_barang($data))
				{
					$this->session->set_flashdata('barang_add', "Data ". strtoupper($kd_barang) ." Sudah Tersimpan Di Batabase, Gambar Tidak Diupload");
				}
				redirect('barang/'); 
			}
			else
			{
			    $error = array('error' => $this->upload->display_errors());
			    $this->input_error();
			}

		}
	}else{
		$this->load->view('barang/input_barang');
	} 
		
		
	}

	public function Edit_barang($kd_barang)
	{
		$data = $this->m_barang->ambil_data_Barang($kd_barang);
	    $title = $this->title;
	    $this->load->view('barang/edit_barang',['title'=>$title,'data'=>$data]);
	}

	public function Update_Barang()
	{
		$this->form_validation->set_rules('nama_barang', 'Nama Barang','required');
		$this->form_validation->set_rules('jumlah_barang', 'Jumlah Barang', 'required|numeric');
		$this->form_validation->set_rules('harga_satuan', 'Harga Satuan', 'required|numeric');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		$this->load->library('upload');
		$nmfile = "file_".time();
		$path   = './images/'; //nama file saya beri nama langsung dan diikuti fungsi time
		$config['upload_path'] = $path; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
		$config['max_size'] = '2048'; //maksimum besar file 2M
		$config['max_width']  = '2288'; //lebar maksimum 1288 px
		$config['max_height']  = '1768'; //tinggi maksimu 768 px
		$config['file_name'] = $nmfile; //nama yang terupload nantinya
		$kd_barang      = $this->input->post('kd_barang');
		$filelama   = $this->input->post('foto');
		$this->upload->initialize($config);
		if($_FILES['foto']['name'])
		{

			if ($this->form_validation->run() && $this->upload->do_upload('foto'))
			{
				 // mahasiswa
				$nama_barang       =   $this->input->post('nama_barang');
				$jumlah_barang      =   $this->input->post('jumlah_barang');
				$harga_satuan      =   $this->input->post('harga_satuan');
				$gbr = $this->upload->data();
				$data         =   array( 	'nama_barang'=>$nama_barang,
				                            'jumlah_barang'=>$jumlah_barang,
				                            'harga_satuan'=>$harga_satuan,
				                            'foto'=>$gbr['file_name']);

				@unlink($path.$filelama);//menghapus gambar lama, variabel dibawa dari form
 
				$where =array('kd_barang'=>$kd_barang); //array where query sebagai identitas pada saat query dijalankan
				if ($this->m_barang->update_barang($data,$where)) 
	            {
	            	$this->session->set_flashdata("barang_edit", "Data ".strtoupper($kd_barang)." Telah Di Edit!!");
	            }
				return redirect('barang/');

			}
			else
			{
				$error = array('error' => $this->upload->display_errors());
				$this->Edit_barang($kd_barang);
			}

		}
		else
		{ /* jika file foto tidak ada maka query yg dijalankan adalah skrip ini  */
			if ($this->form_validation->run())
			{
				$nama_barang        = $this->input->post('nama_barang');
				$data = array(
								'nama_barang'   => $nama_barang,
								'jumlah_barang'  => $this->input->post('jumlah_barang'),
								'harga_satuan'  => $this->input->post('harga_satuan'));

				$where =array('kd_barang'=>$kd_barang); 
	            if ($this->m_barang->update_barang($data,$where)) 
	            {
	            	$this->session->set_flashdata("barang_edit", "Data ".strtoupper($kd_barang)." Telah Di Edit , Gambar Tidak Di Edit !!");
	            }
	            redirect('barang'); 
			}
			else
			{
			    $error = array('error' => $this->upload->display_errors());
			    $this->Edit_barang($kd_barang);
			}

		}
	}


	public function delete_barang($where)
	{
		$path= './images/';
		$rowdel = $this->m_barang->get_byimage($where);
		@unlink($path.$rowdel->foto);
		if ( $this->m_barang->delete_barang($where))
		{
		  $this->session->set_flashdata('barang_delete', "Data Berhasil di hapus");
		}
		return redirect('barang');
	} 


	public function cek_stok()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->model('m_barang');
			$kode = $this->input->post('kd_barang');
			$stok = $this->input->post('stok');

			$get_stok = $this->m_barang->get_stok($kode);
			if($stok > $get_stok->row()->jumlah_barang)
			{
				echo json_encode(array('status' => 0, 'pesan' => "Stok untuk <b>".ucwords($get_stok->row()->nama_barang)."</b> saat ini hanya tersisa <b>".$get_stok->row()->jumlah_barang."</b> !"));
			}
			else
			{
				echo json_encode(array('status' => 1));
			}
		}
	}

	public function input_error()
	{
		$json['status'] = 0;
		$json['pesan'] 	= "<div class='alert alert-warning error_validasi'>".validation_errors()."</div>";
		echo json_encode($json);
	}

}

/* End of file barang.php */
/* Location: ./application/controllers/barang.php */