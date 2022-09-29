<?php 

/**
 * 
 */
class m_chart extends CI_Model
{
	
	public function get_data_open(){
		$bulan = date('m');
		$query = $this->db->query("SELECT
						tbl_transaksi.TglNow, 
						-- COUNT(CASE WHEN tbl_transaksi.Trans_Status = '0' THEN 1 END) AS close,
						COUNT(CASE WHEN tbl_transaksi.TransStatus = '0' THEN 1 END) AS total
					FROM
						tbl_transaksi
					WHERE MONTH(tbl_transaksi.TglNow) = '$bulan'
					GROUP BY
						tbl_transaksi.TglNow
					ORDER BY tbl_transaksi.TglNow ASC");
		return $query->result();
	}

	public function get_data_close(){
		$bulan = date('m');
		$query = $this->db->query("SELECT
									tbl_transaksi.TglNow, 
									COUNT(CASE WHEN tbl_transaksi.TransStatus = '1' THEN 1 END) AS total
									-- COUNT(CASE WHEN tbl_transaksi.Trans_Status = '1' THEN 1 END) AS open
								FROM
									tbl_transaksi
								WHERE MONTH(tbl_transaksi.TglNow) = '$bulan'
								GROUP BY
									tbl_transaksi.TglNow
								ORDER BY tbl_transaksi.TglNow ASC
									");
		return $query->result();
	}

}
 ?>