<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	var $title = "users";
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('url','html');
		$this->load->model('m_users');
		if (!$this->session->userdata('level')) {
			redirect('login');
		}
	}

	public function index()
	{
		$this->data_users();	
	}

	public function data_users()
	{
		$data = $this->m_users->data_users();
		$ambil_id = $this->m_users->data_level_akses();
	    $title = $this->title;
	    $this->load->view('users/data_users',['title'=>$title,'data'=>$data,'level'=>$ambil_id]);
	}

	public function add_user()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'required|max_length[30]');
		$this->form_validation->set_rules('username', 'username', 'required|is_unique[tb_user.username]|max_length[15]');
		$this->form_validation->set_rules('password', 'password','required');
		$this->form_validation->set_rules('confirm_password', 'confirm password', 'required|matches[password]');
		$this->form_validation->set_rules('level', 'Level', 'required');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

			 /* jika file foto tidak ada maka query yg dijalankan adalah skrip ini  */
			if ($this->form_validation->run())
			{
				$nama        = $this->input->post('nama');
				$username        = $this->input->post('username');
				$password        = $this->input->post('password');
				$passwordx       = md5($password);
				$level           = $this->input->post('level');
				$users = array( 'nama'       =>$nama,
								'username'   => $username,
								'password'   => $passwordx,
								'id_akses'      => $level);

				$data =array_merge($users);
				if ($this->m_users->tambah_user($data))
				{
					$this->session->set_flashdata('user_add', "Data ". strtoupper($username) ." Sudah Tersimpan Di Batabase");
				}
				redirect('users/'); 
			}
			else
			{
			    $this->index();
			}
		
	}

	public function Edit_user($id_user)
	{
		$data = $this->m_users->ambil_data_user($id_user);
	    $title = $this->title;
	    $this->load->view('users/edit_user',['title'=>$title,'data'=>$data]);
	}

	public function update_user()
	{
		$this->form_validation->set_rules('username', 'username', 'required|max_length[15]');
		$this->form_validation->set_rules('password', 'password','required');
		$this->form_validation->set_rules('confirm_password', 'confirm password', 'required|matches[password]');
		$this->form_validation->set_rules('level', 'Level', 'required');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		$id_user      = $this->input->post('id_user');
			 /* jika file foto tidak ada maka query yg dijalankan adalah skrip ini  */
			if ($this->form_validation->run())
			{
				$username        = $this->input->post('username');
				$password        = $this->input->post('password');
				$passwordx       = md5($password);
				$level           = $this->input->post('level');
				$users = array(
								'username'   => $username,
								'password'   => $passwordx,
								'level'      => $level);

				$where = array('id_user' => $id_user ,'username'=>$username);
				$data =array_merge($users);
				if ($this->m_users->update_user($data,$where))
				{
					$this->session->set_flashdata('user_edit', "Data ". strtoupper($username) ." Berhasil Di Edit");
				}
				redirect('users/'); 
			}
			else
			{
			    $this->Edit_user($id_user);
			}
	}

	public function delete_user($where)
	{
		if ( $this->m_users->delete_user($where))
		{
		  $this->session->set_flashdata('user_delete', "Data Berhasil di hapus");
		}
		return redirect('users');
	}

}

/* End of file users.php */
/* Location: ./application/controllers/users.php */