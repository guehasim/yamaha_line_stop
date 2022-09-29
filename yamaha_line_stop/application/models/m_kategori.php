<?php 


class m_kategori extends CI_Model
{

	//=================================Katergori
	
	public function lihat_data()
	{
		$query = $this->db->query("SELECT * FROM m_kategori ORDER BY ID_Kategori DESC");
		return $query;
	}

	public function simpan_data()
	{
		$data = array(
			'ID_Kategori'	=> null,
			'NamaKategori'		=> $this->input->post('kategori')
			);

		$this->db->insert('m_kategori',$data);
	}

	public function get_data($id)
	{
		$query = $this->db->query("SELECT * FROM m_kategori WHERE ID_Kategori = $id ");
		return $query;
	}

	public function update_data($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function hapus_data($id)
    {
        $this->db->where('ID_Kategori',$id);
        $this->db->delete('m_kategori');
    }

    //================================= Detail Kategori

    public function lihat_detail($id)
	{
		$query = $this->db->query("SELECT * FROM detail_kategori WHERE ID_Kategori = '$id' ORDER BY ID_DetailKategori DESC");
		return $query;
	}

	public function simpan_detail()
	{
		$data = array(
			'ID_DetailKategori'		=> null,
			'ID_Kategori' 			=> $this->input->post('kategori'),
			'NamaDetailKategori'	=> $this->input->post('namadetail')
			);

		$this->db->insert('detail_kategori',$data);
	}

	public function get_data_detail($id)
	{
		$query = $this->db->query("SELECT * FROM detail_kategori WHERE ID_DetailKategori = $id ");
		return $query;
	}

	public function get_data_details($id)
	{
		$query = $this->db->query("SELECT * FROM detail_kategori WHERE ID_DetailKategori = $id LIMIT 1");
		return $query;
	}

	public function hapus_detail($id)
    {
        $this->db->where('ID_DetailKategori',$id);
        $this->db->delete('detail_kategori');
    }
}
 ?>