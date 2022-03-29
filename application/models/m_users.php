<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_users extends CI_Model {
	var $tabel = "tb_user";

	function validasi_login($username, $password)
	{
		return $this->db
			->select('a.id_user, a.username, a.password, a.nama, b.label AS level, b.level_akses AS level_caption', false)
			->join('pj_akses b', 'a.id_akses = b.id_akses', 'left')
			->where('a.username', $username)
			->where('a.password', md5($password))
			->limit(1)
			->get('tb_user a');
	}
	public function user_login($username, $password)
	{
		$this->db->select('*');
		$this->db->from($this->tabel);
		$this->db->where(['username'=>$username,'password'=>md5($password)]);
		$query = $this->db->get();
		if ($query->num_rows() > 0) 
		{
			foreach ($query->result() as $row) 
			{
				if ($row->level == 'admin') 
				{	
					$ambil_data_kasir = $this->db->get_where('tb_kasir',['nama_kasir'=>$username]);
					foreach ($ambil_data_kasir->result() as $data) {
						$session = array('username' => $username,
										'id_kasir'=>$data->id_kasir,
										 'level'=>'admin',
										 'foto'=>$data->foto );
						$this->session->set_userdata($session);
					}
					echo "<script>alert('Selamat Datang $username Anda berhasil login');</script>";
					redirect('admin','refresh');
				}
				elseif ($row->level == 'kasir') 
				{	
					$ambil_data_kasir = $this->db->get_where('tb_kasir',['nama_kasir'=>$username]);
					foreach ($ambil_data_kasir->result() as $data) {
						$session = array('username' => $username,
										'id_kasir'=>$data->id_kasir,
										 'level'=>'kasir',
										 'foto'=>$data->foto );
						$this->session->set_userdata($session);
					}
					echo "<script>alert('Selamat Datang $username Anda berhasil login');</script>";
					redirect('transaksi','refresh');	
				} 
					
			}	
		} 
		else 
		{
			$this->session->set_flashdata('login_response', 'Login Gagal!! Username Dan Password Tidak Valid!!');
			redirect('login');
		}
		
	}

	// public function data_users()
	// {
	// 	$this->db->select('*');
	// 	$this->db->from($this->tabel);
	// 	$query = $this->db->get('');
	// 	return $query->result();
	// }
	function data_users()
	{
		return $this->db
			->select('a.nama,a.id_user, a.username, b.label AS level, b.level_akses AS level_caption', false)
			->join('pj_akses b', 'a.id_akses = b.id_akses', 'left')
			->get('tb_user a');
	}

	public function tambah_user($data)
	{
		$this->db->insert('tb_user',$data);
		return TRUE;
	}

	public function ambil_data_user($id_user)
	{
		$this->db->where('id_user', $id_user);
		$result = $this->db->get($this->tabel);
		return $result->row();
	}

	public function update_user($data,$where)
	{
		$this->db->where($where);
		$this->db->update('tb_user', $data);
		return TRUE;
	}


	public function delete_user($where)
  {
       $this->db->where('id_user',$where);
       $this->db->delete("tb_user");
       return TRUE;
  }

  public function data_level_akses()
  {
    // $this->db->order_by('nama_kasir', 'ASC');
    return $this->db->get('pj_akses');
  }

  public function tampil_data_kasir()
  {
    // $this->db->order_by('nama_kasir', 'ASC');
    return $this->db->get('tb_user');
  }

  function get_baris($id_user)
	{
		$sql = "
			SELECT 
				a.`id_user`,
				a.`username`,
				a.`nama`,
				a.`id_akses`,
				b.`label` 
			FROM 
				`tb_user` a 
				LEFT JOIN `pj_akses` b ON a.`id_akses` = b.`id_akses` 
			WHERE 
				a.`id_user` = '".$id_user."' 
			LIMIT 1
		";

		return $this->db->query($sql);
	}

	function is_valid($u, $p)
	{
		return $this->db
			->select('id_user')
			->where('id_user', $u)
			->where('password', $p)
			->where('status','Aktif')
			->where('dihapus','tidak')
			->limit(1)
			->get('pj_user');
	}

}

/* End of file m_users.php */
/* Location: ./application/models/m_users.php */