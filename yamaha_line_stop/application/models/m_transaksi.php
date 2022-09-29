<?php 


class m_transaksi extends CI_Model
{
	
	public function lihat_admin()
	{
		$query = $this->db->query("SELECT
									tbl_transaksi.ID_Transaksi,
									m_kategori.NamaKategori, 
									detail_kategori.NamaDetailKategori, 
									tbl_transaksi.TglBegin, 
									m_user.NamaUser, 
									m_user.DeptUser, 
									tbl_transaksi.Deskripsi, 
									tbl_transaksi.DocBegin, 
									tbl_transaksi.TglNow, 
									tbl_transaksi.TglAfter, 
									tbl_transaksi.ID_User, 
									tbl_transaksi.ID_DetailKategori, 
									tbl_transaksi.Action, 
									tbl_transaksi.DocAfter,
									tbl_transaksi.TransStatus
								FROM
									tbl_transaksi
									INNER JOIN
									m_user
									ON 
										tbl_transaksi.ID_User = m_user.ID_User
									INNER JOIN
									detail_kategori
									ON 
										tbl_transaksi.ID_DetailKategori = detail_kategori.ID_DetailKategori
									INNER JOIN
									m_kategori
									ON 
										detail_kategori.ID_Kategori = m_kategori.ID_Kategori
								ORDER BY
									tbl_transaksi.ID_Transaksi DESC");
		return $query;
	}

	public function lihat_karyawan($id)
	{
		$query = $this->db->query("SELECT
									tbl_transaksi.ID_Transaksi,
									m_kategori.NamaKategori, 
									detail_kategori.NamaDetailKategori, 
									tbl_transaksi.TglBegin, 
									m_user.NamaUser, 
									m_user.DeptUser, 
									tbl_transaksi.Deskripsi, 
									tbl_transaksi.DocBegin, 
									tbl_transaksi.TglNow, 
									tbl_transaksi.TglAfter, 
									tbl_transaksi.ID_User, 
									tbl_transaksi.ID_DetailKategori, 
									tbl_transaksi.Action, 
									tbl_transaksi.DocAfter,
									tbl_transaksi.TransStatus
								FROM
									tbl_transaksi
									INNER JOIN
									m_user
									ON 
										tbl_transaksi.ID_User = m_user.ID_User
									INNER JOIN
									detail_kategori
									ON 
										tbl_transaksi.ID_DetailKategori = detail_kategori.ID_DetailKategori
									INNER JOIN
									m_kategori
									ON 
										detail_kategori.ID_Kategori = m_kategori.ID_Kategori
								WHERE
									tbl_transaksi.ID_User = '$id'
								ORDER BY
									tbl_transaksi.ID_Transaksi DESC");
		return $query;
	}

	public function get_karyawan($nik)
	{
		$this->db->like('NikUser',$nik,'both');
		$this->db->order_by('ID_User','DESC');
		$this->db->limit(10);
		return $this->db->get('m_user')->result();
	}

	public function lihat_pdf($period_awal,$period_akhir,$status_laporan)
	{
		if ($status_laporan == '') {
			$tampil = "WHERE tbl_transaksi.TglNow BETWEEN '$period_awal' AND '$period_akhir' ";
		} else {
			$tampil = "WHERE tbl_transaksi.TglNow BETWEEN '$period_awal' AND '$period_akhir' AND tbl_transaksi.TransStatus = '$status_laporan' ";
		}

		$query = $this->db->query("SELECT
									tbl_transaksi.ID_Transaksi,
									m_kategori.NamaKategori, 
									detail_kategori.NamaDetailKategori, 
									tbl_transaksi.TglBegin,
									m_user.NikUser, 
									m_user.NamaUser, 
									m_user.DeptUser, 
									tbl_transaksi.Deskripsi, 
									tbl_transaksi.DocBegin, 
									tbl_transaksi.TglNow, 
									tbl_transaksi.TglAfter, 
									tbl_transaksi.ID_User, 
									tbl_transaksi.ID_DetailKategori, 
									tbl_transaksi.Action, 
									tbl_transaksi.DocAfter,
									tbl_transaksi.TransStatus
								FROM
									tbl_transaksi
									INNER JOIN
									m_user
									ON 
										tbl_transaksi.ID_User = m_user.ID_User
									INNER JOIN
									detail_kategori
									ON 
										tbl_transaksi.ID_DetailKategori = detail_kategori.ID_DetailKategori
									INNER JOIN
									m_kategori
									ON 
										detail_kategori.ID_Kategori = m_kategori.ID_Kategori
								$tampil
								ORDER BY
									tbl_transaksi.ID_Transaksi DESC");
		return $query;
		
	}

	public function simpan_data($gambar)
	{
		$data = array(
			'ID_Transaksi'		=> null,
			'TglNow'			=> date('Y-m-d',strtotime($this->input->post('tanggal_now'))),
			'TglBegin'			=> date('Y-m-d',strtotime($this->input->post('tanggal_begin'))),
			'TglAfter' 			=> date('Y-m-d',strtotime($this->input->post('tanggal_after'))),
			'ID_User' 			=> $this->input->post('karyawan'),
			'ID_DetailKategori' => $this->input->post('detail_kategori'),
			'Deskripsi' 		=> $this->input->post('deskripsi'),
			'DocBegin' 			=> $gambar,
			'Action' 			=> null,
			'DocAfter' 			=> null,
			'TransStatus' 		=> 0
			);

		$this->db->insert('tbl_transaksi',$data);
	}

	public function get_data($ids)
	{
		$query = $this->db->query("SELECT
									tbl_transaksi.ID_Transaksi,
									m_kategori.NamaKategori, 
									detail_kategori.NamaDetailKategori, 
									tbl_transaksi.TglBegin,
									m_user.NikUser, 
									m_user.NamaUser, 
									m_user.DeptUser, 
									tbl_transaksi.Deskripsi, 
									tbl_transaksi.DocBegin, 
									tbl_transaksi.TglNow, 
									tbl_transaksi.TglAfter, 
									tbl_transaksi.ID_User, 
									tbl_transaksi.ID_DetailKategori, 
									tbl_transaksi.Action, 
									tbl_transaksi.DocAfter,
									tbl_transaksi.TransStatus,
									detail_kategori.ID_Kategori
								FROM
									tbl_transaksi
									INNER JOIN
									m_user
									ON 
										tbl_transaksi.ID_User = m_user.ID_User
									INNER JOIN
									detail_kategori
									ON 
										tbl_transaksi.ID_DetailKategori = detail_kategori.ID_DetailKategori
									INNER JOIN
									m_kategori
									ON 
										detail_kategori.ID_Kategori = m_kategori.ID_Kategori
								WHERE
									tbl_transaksi.ID_Transaksi = '$ids' ");
		return $query;
	}

	public function update_data($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function hapus_data($id)
    {
        $this->db->where('ID_Transaksi',$id);
        $this->db->delete('tbl_transaksi');
    }
}
 ?>