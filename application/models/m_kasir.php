<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kasir extends CI_Model {

	var $table = "tb_kasir";

	public function data_kasir()
	{
		
    $this->db->select("*");
    $this->db->from($this->table);
    // $this->db->order_by('nama_matkul', 'desc');
    $this->db->order_by('nama_kasir','asc');
    $query = $this->db->get();
    return $query;
	}

  public function tampil_data_kasir()
  {
    // $this->db->order_by('nama_kasir', 'ASC');
    return $this->db->get('tb_kasir');
  }

	public function ambil_data_kasir($id_kasir)
	{
		$this->db->where('id_kasir', $id_kasir);
        $result = $this->db->get($this->table);
        return $result->row();
	}

	public function tambah_kasir($data)
	{
		$this->db->insert($this->table,$data);
		return TRUE;
	}

	//fungsi update ke database
    public function update_kasir($data,$where){
       $this->db->where($where);
       $this->db->update($this->table, $data);
       return TRUE;
    }

    public function get_byimage($where) {
        $this->db->from($this->table);
        $this->db->where('id_kasir',$where);
        $query = $this->db->get();
 
        //cek apakah ada data
        if ($query->num_rows() == 1) {
            return $query->row();
        }
    }

    public function delete_kasir($where){
       $this->db->where('id_kasir',$where);
       $this->db->delete($this->table);
       return TRUE;
    }

}

/* End of file m_kasir.php */
/* Location: ./application/models/m_kasir.php */