<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_barang extends CI_Model {

	var $table = "pj_barang";

	public function data_barang()
	{
    // $sql = "SELECT * sum(jumlah_barang * harga_satuan) AS total_harga FROM tb_barang";
    $sql = "SELECT kd_barang, nama_barang,jumlah_barang,harga_satuan,foto, (jumlah_barang * harga_satuan) as total_jumlah FROM pj_barang GROUP BY kd_barang";
		// $this->db->select('*');
		// $this->db->from($this->table);
    $query = $this->db->query($sql);
		// $query = $this->db->get();
		return $query->result();	
	}

  public function sum_harga_satuan()
  {
    $this->db->select_sum('harga_satuan', 'total_harga');
    $this->db->from('pj_barang');
    $query = $this->db->get();
    return $query->row();  
  }

  public function sum_jumlah_barang()
  {
    $this->db->select_sum('jumlah_barang', 'total_jumlah_barang');
    $this->db->from('pj_barang');
    $query = $this->db->get();
    return $query->row();  
  }

	public function ambil_data_Barang($kd_barang)
	{
		$this->db->where('kd_barang', $kd_barang);
        $result = $this->db->get($this->table);
        return $result->row();
	}

	public function tambah_barang($data)
	{
		$this->db->insert('pj_barang',$data);
		return TRUE;
	}

	//fungsi update ke database
  public function update_barang($data,$where)
  {
      $this->db->where($where);
      $this->db->update('pj_barang', $data);
      return TRUE;
  }

  public function get_byimage($where) 
  {
        $this->db->from("pj_barang");
        $this->db->where('kd_barang',$where);
        $query = $this->db->get();
 
        //cek apakah ada data
        if ($query->num_rows() == 1) {
            return $query->row();
        }
  }

  public function delete_barang($where)
  {
       $this->db->where('kd_barang',$where);
       $this->db->delete("pj_barang");
       return TRUE;
  }

  function cari_kode($keyword, $registered)
  {
    $not_in = '';

    $koma = explode(',', $registered);
    if(count($koma) > 1)
    {
      $not_in .= " AND `kd_barang` NOT IN (";
      foreach($koma as $k)
      {
        $not_in .= " '".$k."', ";
      }
      $not_in = rtrim(trim($not_in), ',');
      $not_in = $not_in.")";
    }
    if(count($koma) == 1)
    {
      $not_in .= " AND `kd_barang` != '".$registered."' ";
    }

    $sql = "
      SELECT 
        `kd_barang`, `nama_barang`, `harga_satuan` 
      FROM 
        `pj_barang` 
      WHERE 
       `jumlah_barang` > 0 
        AND ( 
          `kd_barang` LIKE '%".$this->db->escape_like_str($keyword)."%' 
          OR `nama_barang` LIKE '%".$this->db->escape_like_str($keyword)."%' 
        ) 
        ".$not_in." 
    ";

    return $this->db->query($sql);
  }


  function get_stok($kode)
  {
    return $this->db
      ->select('nama_barang, jumlah_barang')
      ->where('kd_barang', $kode)
      ->limit(1)
      ->get('pj_barang');
  }

  function update_stok($id_barang, $jumlah_beli)
  {
    $sql = "
      UPDATE `pj_barang` SET `jumlah_barang` = `jumlah_barang` - ".$jumlah_beli." WHERE `id_barang` = '".$id_barang."'
    ";

    return $this->db->query($sql);
  }

  function get_id($kd_barang)
  {
    return $this->db
      ->select('id_barang, nama_barang')
      ->where('kd_barang', $kd_barang)
      ->limit(1)
      ->get('pj_barang');
  }

  function cek_kode($kode)
  {
    return $this->db
      ->select('id_barang')
      ->where('kd_barang', $kode)
      ->limit(1)
      ->get('pj_barang');
  }


}

/* End of file m_barang.php */
/* Location: ./application/models/m_barang.php */