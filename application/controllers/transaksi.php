<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

	var $title = "Transaksi";
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
		$this->data_transaksi();	
	}

	public function data_transaksi()
	{
		
		$level = $this->session->userdata('level');
		if($level == 'admin' OR $level == 'kasir')
		{
			if($_POST)
			{
				if( ! empty($_POST['kd_barang']))
				{
					$total = 0;
					foreach($_POST['kd_barang'] as $k)
					{
						if( ! empty($k)){ $total++; }
					}

					if($total > 0)
					{
						$this->load->library('form_validation');
						$this->form_validation->set_rules('nomor_nota','Nomor Nota','trim|required|max_length[40]|alpha_numeric|callback_cek_nota[nomor_nota]');
						$this->form_validation->set_rules('tanggal','Tanggal','trim|required');
						
						$no = 0;
						foreach($_POST['kd_barang'] as $d)
						{
							if( ! empty($d))
							{
								$this->form_validation->set_rules('kd_barang['.$no.']','Kode Barang #'.($no + 1), 'trim|required|max_length[40]|callback_cek_kd_barang[kd_barang['.$no.']]');
								$this->form_validation->set_rules('jumlah_beli['.$no.']','Qty #'.($no + 1), 'trim|numeric|required|callback_cek_nol[jumlah_beli['.$no.']]');
							}

							$no++;
						}
						
						$this->form_validation->set_rules('cash','Total Bayar', 'trim|numeric|required|max_length[17]');
						$this->form_validation->set_rules('catatan','Catatan', 'trim|max_length[1000]');

						$this->form_validation->set_message('required', '%s harus diisi');
						$this->form_validation->set_message('cek_kd_barang', '%s tidak ditemukan');
						$this->form_validation->set_message('cek_nota', '%s sudah ada');
						$this->form_validation->set_message('cek_nol', '%s tidak boleh nol');
						$this->form_validation->set_message('alpha_numeric', '%s Harus huruf / angka !');

						if($this->form_validation->run() == TRUE)
						{
							$nomor_nota 	= $this->input->post('nomor_nota');
							$tanggal		= $this->input->post('tanggal');
							$id_kasir		= $this->input->post('id_kasir');
							$id_pelanggan	= $this->input->post('id_pelanggan');
							$bayar			= $this->input->post('cash');
							$grand_total	= $this->input->post('grand_total');
							$catatan		= $this->clean_tag_input($this->input->post('catatan'));

							if($bayar < $grand_total)
							{
								$this->query_error("Cash Kurang");
							}
							else
							{
								$this->load->model('m_penjualan_master');
								$master = $this->m_penjualan_master->insert_master($nomor_nota, $tanggal, $id_kasir, $id_pelanggan, $bayar, $grand_total, $catatan);
								if($master)
								{
									$id_master 	= $this->m_penjualan_master->get_id($nomor_nota)->row()->id_penjualan_m;
									$inserted	= 0;

									$this->load->model('m_penjualan_detail');
									$this->load->model('m_barang');

									$no_array	= 0;
									foreach($_POST['kd_barang'] as $k)
									{
										if( ! empty($k))
										{
											$kd_barang 	= $_POST['kd_barang'][$no_array];
											$jumlah_beli 	= $_POST['jumlah_beli'][$no_array];
											$harga_satuan 	= $_POST['harga_satuan'][$no_array];
											$sub_total 		= $_POST['sub_total'][$no_array];
											$id_barang		= $this->m_barang->get_id($kd_barang)->row()->id_barang;
											
											$insert_detail	= $this->m_penjualan_detail->insert_detail($id_master, $id_barang, $jumlah_beli, $harga_satuan, $sub_total);
											if($insert_detail)
											{
												$this->m_barang->update_stok($id_barang, $jumlah_beli);
												$inserted++;
											}
										}

										$no_array++;
									}

									if($inserted > 0)
									{
										echo json_encode(array('status' => 1, 'pesan' => "Transaksi berhasil disimpan !"));
									}
									else
									{
										$this->query_error();
									}
								}
								else
								{
									$this->query_error();
								}
							}
						}
						else
						{
							echo json_encode(array('status' => 0, 'pesan' => validation_errors("<font color='red'>- ","</font><br />")));
						}
					}
					else
					{
						$this->query_error("Harap masukan minimal 1 kode barang !");
					}
				}
				else
				{
					$this->query_error("Harap masukan minimal 1 kode barang !");
				}
			}
			else
			{
				$this->load->model('m_users');
				$this->load->model('m_pelanggan');
				$dt['title'] =$this->title;
				$dt['kasir'] = $this->m_users->tampil_data_kasir();
				$dt['pelanggan']= $this->m_pelanggan->get_all();
				$this->load->view('transaksi/data_transaksi', $dt);
			}
		}
				
			
	}

	public function ajax_pelanggan()
	{
		if($this->input->is_ajax_request())
		{
			$id_pelanggan = $this->input->post('id_pelanggan');
			$this->load->model('m_pelanggan');

			$data = $this->m_pelanggan->get_baris($id_pelanggan)->row();
			$json['telp']			= ( ! empty($data->telp)) ? $data->telp : "<small><i>Tidak ada</i></small>";
			$json['alamat']			= ( ! empty($data->alamat)) ? preg_replace("/\r\n|\r|\n/",'<br />', $data->alamat) : "<small><i>Tidak ada</i></small>";
			$json['info_tambahan']	= ( ! empty($data->info_tambahan)) ? preg_replace("/\r\n|\r|\n/",'<br />', $data->info_tambahan) : "<small><i>Tidak ada</i></small>";
			echo json_encode($json);
		}
	}

	public function ajax_kode()
	{
		if($this->input->is_ajax_request())
		{
			$keyword 	= $this->input->post('keyword');
			$registered	= $this->input->post('registered');

			$this->load->model('m_barang');

			$barang = $this->m_barang->cari_kode($keyword, $registered);

			if($barang->num_rows() > 0)
			{
				$json['status'] 	= 1;
				$json['datanya'] 	= "<ul class='label-hover' id='daftar-autocomplete'>";
				foreach($barang->result() as $b)
				{
					$json['datanya'] .= "
						<li>
							<b>Kode</b> : 
							<span id='kodenya'>".strtoupper($b->kd_barang)."</span> <br />
							<span id='barangnya'>".ucwords($b->nama_barang)."</span>
							<span id='harganya' style='display:none;'>".$b->harga_satuan."</span>
						</li>
					";
				}
				$json['datanya'] .= "</ul>";
			}
			else
			{
				$json['status'] 	= 0;
			}

			echo json_encode($json);
		}
	}


	public function tambah_pelanggan()
	{
		$level = $this->session->userdata('level');
		if($level == 'admin' OR $level == 'kasir' OR $level == 'keuangan')
		{
			if($_POST)
			{
				$this->load->library('form_validation');
				$this->form_validation->set_rules('nama','Nama','trim|required|max_length[40]');
				$this->form_validation->set_rules('alamat','Alamat','trim|required|max_length[1000]');
				$this->form_validation->set_rules('telepon','Telepon / Handphone','trim|required|numeric|max_length[40]');
				$this->form_validation->set_rules('info','Info Tambahan Lainnya','trim|max_length[1000]');

				$this->form_validation->set_message('alpha_spaces','%s harus alphabet !');
				$this->form_validation->set_message('numeric','%s harus angka !');
				$this->form_validation->set_message('required','%s harus diisi !');

				if($this->form_validation->run() == TRUE)
				{
					$this->load->model('m_pelanggan');
					$nama 		= $this->input->post('nama');
					$alamat 	= $this->clean_tag_input($this->input->post('alamat'));
					$telepon 	= $this->input->post('telepon');
					$info 		= $this->clean_tag_input($this->input->post('info'));

					$unique		= time().$this->session->userdata('id_kasir');
					$insert 	= $this->m_pelanggan->tambah_pelanggan($nama, $alamat, $telepon, $info, $unique);
					if($insert)
					{
						$id_pelanggan = $this->m_pelanggan->get_dari_kode($unique)->row()->id_pelanggan;
						echo json_encode(array(
							'status' => 1,
							'pesan' => "<div class='alert alert-success'><i class='fa fa-check'></i> <b>".$nama."</b> berhasil ditambahkan sebagai pelanggan.</div>",
							'id_pelanggan' => $id_pelanggan,
							'nama' => $nama,
							'alamat' => preg_replace("/\r\n|\r|\n/",'<br />', $alamat),
							'telepon' => $telepon,
							'info' => (empty($info)) ? "<small><i>Tidak ada</i></small>" : preg_replace("/\r\n|\r|\n/",'<br />', $info)						
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
			}
			else
			{
				$this->load->view('transaksi/pelanggan_tambah');
			}
		}
	}

	public function waktu()
	{
		date_default_timezone_set('Asia/Jakarta');
		$hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
		$bulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		$jam = date("H:i:s");
		return $hari[date("w")].", ".date("j")." ".$bulan[date("n")]." ".date("Y")." ".$jam;
	}


	public function transaksi_cetak()
	{
		$nomor_nota 	= $this->input->get('nomor_nota');
		$tanggal		= $this->input->get('tanggal');
		$id_kasir		= $this->input->get('id_kasir');
		$id_pelanggan	= $this->input->get('id_pelanggan');
		$cash			= $this->input->get('cash');
		$catatan		= $this->input->get('catatan');
		$grand_total	= $this->input->get('grand_total');

		$this->load->model('m_users');
		$kasir = $this->m_users->get_baris($id_kasir)->row()->nama;
		
		$this->load->model('m_pelanggan');
		$pelanggan = 'umum';
		if( ! empty($id_pelanggan))
		{
			$pelanggan = $this->m_pelanggan->get_baris($id_pelanggan)->row()->nama;
		}

		$this->load->library('cfpdf');		
		$pdf = new FPDF('P','mm','A5');
		$pdf->AddPage();
		$pdf->SetFont('Arial','',10);

		$pdf->Cell(25, 4, 'Nota', 0, 0, 'L'); 
		$pdf->Cell(85, 4, $nomor_nota, 0, 0, 'L');
		$pdf->Ln();
		$pdf->Cell(25, 4, 'Tanggal', 0, 0, 'L'); 
		// $pdf->Cell(85, 4, date('d-M-Y H:i:s', strtotime($tanggal)), 0, 0, 'L');
		$pdf->Cell(85, 4, $this->waktu(strtotime($tanggal)), 0, 0, 'L');
		$pdf->Ln();
		$pdf->Cell(25, 4, 'Kasir', 0, 0, 'L'); 
		$pdf->Cell(85, 4, ucwords($kasir), 0, 0, 'L');
		$pdf->Ln();
		$pdf->Cell(25, 4, 'Pelanggan', 0, 0, 'L'); 
		$pdf->Cell(85, 4, ucwords($pelanggan), 0, 0, 'L');
		$pdf->Ln();
		$pdf->Ln();

		$pdf->Cell(130, 5, '-----------------------------------------------------------------------------------------------------------', 0, 0, 'L');
		$pdf->Ln();
		
		$pdf->Cell(25, 5, 'Kode', 0, 0, 'L');
		$pdf->Cell(40, 5, 'Item', 0, 0, 'L');
		$pdf->Cell(20, 5, 'Harga', 0, 0, 'L');
		$pdf->Cell(20, 5, 'Jml beli', 0, 0, 'L');
		$pdf->Cell(25, 5, 'Subtotal', 0, 0, 'L');
		$pdf->Ln();

		$pdf->Cell(130, 5, '-----------------------------------------------------------------------------------------------------------', 0, 0, 'L');
		$pdf->Ln();

		$this->load->model('m_barang');
		$this->load->helper('text');

		$no = 0;
		foreach($_GET['kd_barang'] as $kd)
		{
			if( ! empty($kd))
			{
				$nama_barang = $this->m_barang->get_id($kd)->row()->nama_barang;
				$nama_barang = character_limiter($nama_barang, 20, '..');

				$pdf->Cell(25, 5, $kd, 0, 0, 'L');
				$pdf->Cell(40, 5, ucwords($nama_barang), 0, 0, 'L');
				$pdf->Cell(25, 5, str_replace(',', '.', number_format($_GET['harga_satuan'][$no])), 0, 0, 'L');
				$pdf->Cell(15, 5, $_GET['jumlah_beli'][$no], 0, 0, 'L');
				$pdf->Cell(30, 5, str_replace(',', '.', number_format($_GET['sub_total'][$no])), 0, 0, 'L');
				$pdf->Ln();

				$no++;
			}
		}

		$pdf->Cell(130, 5, '-----------------------------------------------------------------------------------------------------------', 0, 0, 'L');
		$pdf->Ln();

		$pdf->Cell(105, 5, 'Total Bayar', 0, 0, 'R');
		$pdf->Cell(25, 5, str_replace(',', '.', number_format($grand_total)), 0, 0, 'L');
		$pdf->Ln();

		$pdf->Cell(105, 5, 'Cash', 0, 0, 'R');
		$pdf->Cell(25, 5, str_replace(',', '.', number_format($cash)), 0, 0, 'L');
		$pdf->Ln();

		$pdf->Cell(105, 5, 'Kembali', 0, 0, 'R');
		$pdf->Cell(25, 5, str_replace(',', '.', number_format(($cash - $grand_total))), 0, 0, 'L');
		$pdf->Ln();

		$pdf->Cell(130, 5, '-----------------------------------------------------------------------------------------------------------', 0, 0, 'L');
		$pdf->Ln();

		$pdf->Cell(25, 5, 'Catatan : ', 0, 0, 'L');
		$pdf->Ln();
		$pdf->Cell(130, 5, (($catatan == '') ? 'Tidak Ada' : ucwords($catatan)), 0, 0, 'L');
		$pdf->Ln();

		$pdf->Cell(130, 5, '-----------------------------------------------------------------------------------------------------------', 0, 0, 'L');
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Cell(130, 5, "Terimakasih Telah Berbelanja Dengan Kami", 0, 0, 'C');
		ob_clean();
		$pdf->Output();
	}


		public function history()
	{
		$level = $this->session->userdata('level');
		if($level == 'admin' OR $level == 'kasir' OR $level == 'keuangan')
		{
			$title = $this->title;
			$this->load->view('transaksi/history_transaksi',['title'=>$title]);
		}
	}

	public function history_json()
	{
		$this->load->model('m_penjualan_master');
		$level 			= $this->session->userdata('level');

		$requestData	= $_REQUEST;
		$fetch			= $this->m_penjualan_master->fetch_data_penjualan($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);
		
		$totalData		= $fetch['totalData'];
		$totalFiltered	= $fetch['totalFiltered'];
		$query			= $fetch['query'];

		$data	= array();
		foreach($query->result_array() as $row)
		{ 
			$nestedData = array(); 

			$nestedData[]	= $row['nomor'];
			$nestedData[]	= $row['tanggal'];
			$nestedData[]	= "<a href='".site_url('transaksi/detail_transaksi/'.$row['id_penjualan_m'])."' id='LihatDetailTransaksi'><i class='fa fa-file-text-o fa-fw'></i> ".$row['nomor_nota']."</a>";
			$nestedData[]	= $row['grand_total'];
			$nestedData[]	= ucwords($row['nama_pelanggan']);
			$nestedData[]	= preg_replace("/\r\n|\r|\n/",'<br />', ucwords($row['keterangan']));
			$nestedData[]	= ucwords($row['kasir']);
		
			if($level == 'admin' OR $level == 'keuangan')
			{
				$nestedData[]	= "<a href='".site_url('transaksi/hapus_transaksi/'.$row['id_penjualan_m'])."' id='HapusTransaksi'><i class='btn btn-sm btn-danger fa fa-trash-o'></i></a>";
			}

			$data[] = $nestedData;
		}

		$json_data = array(
			"draw"            => intval( $requestData['draw'] ),  
			"recordsTotal"    => intval( $totalData ),  
			"recordsFiltered" => intval( $totalFiltered ), 
			"data"            => $data
			);

		echo json_encode($json_data);
	}

	public function detail_transaksi($id_penjualan)
	{
		if($this->input->is_ajax_request())
		{
			$this->load->model('m_penjualan_detail');
			$this->load->model('m_penjualan_master');

			$dt['detail'] = $this->m_penjualan_detail->get_detail($id_penjualan);
			$dt['master'] = $this->m_penjualan_master->get_baris($id_penjualan)->row();
			
			$this->load->view('transaksi/transaksi_history_detail', $dt);
		}
	}

	public function hapus_transaksi($id_penjualan)
	{
		if($this->input->is_ajax_request())
		{
			$level 	= $this->session->userdata('level');
			if($level == 'admin')
			{
				$reverse_stok = $this->input->post('reverse_stok');

				$this->load->model('m_penjualan_master');

				$nota 	= $this->m_penjualan_master->get_baris($id_penjualan)->row()->nomor_nota;
				$hapus 	= $this->m_penjualan_master->hapus_transaksi($id_penjualan, $reverse_stok);
				if($hapus)
				{
					echo json_encode(array(
						"pesan" => "<font color='green'><i class='fa fa-check'></i> Transaksi <b>".$nota."</b> berhasil dihapus !</font>
					"));
				}
				else
				{
					echo json_encode(array(
						"pesan" => "<font color='red'><i class='fa fa-warning'></i> Terjadi kesalahan, coba lagi !</font>
					"));
				}
			}
		}
	}



	function input_error()
	{
		$json['status'] = 0;
		$json['pesan'] 	= "<div class='alert alert-warning error_validasi'>".validation_errors()."</div>";
		echo json_encode($json);
	}

	function query_error($pesan = "Terjadi kesalahan, coba lagi !")
	{
		$json['status'] = 2;
		$json['pesan'] 	= "<div class='alert alert-danger error_validasi'>".$pesan."</div>";
		echo json_encode($json);
	}

	function clean_tag_input($str)
	{
		$t = preg_replace('/<[^<|>]+?>/', '', htmlspecialchars_decode($str));
		$t = htmlentities($t, ENT_QUOTES, "UTF-8");
		$t = trim($t);
		return $t;
	}


	public function cek_nota($nota)
	{
		$this->load->model('m_penjualan_master');
		$cek = $this->m_penjualan_master->cek_nota_validasi($nota);

		if($cek->num_rows() > 0)
		{
			return FALSE;
		}
		return TRUE;
	}

	public function cek_kd_barang($kode)
	{
		$this->load->model('m_barang');
		$cek_kode = $this->m_barang->cek_kode($kode);

		if($cek_kode->num_rows() > 0)
		{
			return TRUE;
		}
		return FALSE;
	}

	public function cek_nol($qty)
	{
		if($qty > 0){
			return TRUE;
		}
		return FALSE;
	}

}

/* End of file transaksi.php */
/* Location: ./application/controllers/transaksi.php */