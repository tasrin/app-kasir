<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_transaksi extends CI_Model {

	public function data_transaksi()
	{
		$this->db->select('*');
		$this->db->from('tb_transaksi');
		$query = $this->db->get('');
		return $query->result();
	}

}

/* End of file m_transaksi.php */
/* Location: ./application/models/m_transaksi.php */