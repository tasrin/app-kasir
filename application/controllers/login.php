<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	var $title = "Halaman Login Sistem";
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('url','form','html');
		$this->load->model('m_users');
	}

	public function index()
	{	
		if($this->session->userdata('level') == 'admin') 
        {
            return redirect('admin');
        }
        
		$title = $this->title;
		$this->load->view('login',['title'=>$title]);
	}

	public function login_user()
	{
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        // if ($this->form_validation->run())
        // {
        //    $username = $this->input->post('username');
        //    $password = $this->input->post('password');
        //    $this->m_users->user_login($username,$password);
        // }
        if($this->form_validation->run() == TRUE)
        {
            $username   = $this->input->post('username');
            $password   = $this->input->post('password');

            $this->load->model('m_users');
            $validasi_login = $this->m_users->validasi_login($username, $password);

            if($validasi_login->num_rows() > 0)
            {
                $data_user = $validasi_login->row();

                $session = array(
                    'id_user' => $data_user->id_user,
                    'password' => $data_user->password,
                    'nama' => $data_user->nama,
                    'username'=>$data_user->username,
                    'level' => $data_user->level,
                    'level_caption' => $data_user->level_caption
                );
                $this->session->set_userdata($session); 

                if ($data_user->level == 'admin') {
                    echo "<script>alert('Selamat Datang $data_user->nama Anda berhasil login');</script>";
                    redirect('admin','refresh');
                } elseif ($data_user->level == 'kasir'){
                    echo "<script>alert('Selamat Datang $data_user->nama Anda berhasil login');</script>";
                    redirect('transaksi','refresh');
                }
                
            }
            else
            {
                $this->session->set_flashdata('login_response', 'Login Gagal!! Username Dan Password Tidak Valid!!');
                redirect('login');
            }
        }
        else
        {
            $this->index();
        }	
    }

    public function logout()
    {
    	$this->session->sess_destroy();
        $this->session->unset_userdata(array('level', 'username'));
        redirect('login');
    }

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */