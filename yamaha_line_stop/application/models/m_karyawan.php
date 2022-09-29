<?php 


class m_karyawan extends CI_Model
{
	
	public function lihat_data()
	{
		$query = $this->db->query("SELECT * FROM m_user WHERE StatusUser = '1' ORDER BY ID_user DESC");
		return $query;
	}

	public function lihat_temp()
	{
		$query = $this->db->query("SELECT
								import_user_temp.NikUser_Temp, 
								import_user_temp.NamaUser_Temp, 
								import_user_temp.DeptUser_Temp, 
								import_user_temp.Username_Temp, 
								import_user_temp.PassUser_Temp, 
								m_user.NikUser,
								m_user.Username
							FROM
								import_user_temp
								LEFT JOIN
								m_user
								ON 
									import_user_temp.NikUser_Temp = m_user.NikUser
								ORDER BY ID_User_Temp ASC");
		return $query;
	}

	public function simpan_data()
	{
		$data = array(
			'ID_user'		=> null,
			'NikUser'		=> $this->input->post('nik'),
			'NamaUser'		=> $this->input->post('nama'),
			'DeptUser' 		=> $this->input->post('dept'),
			'StatusUser'	=> 1,
			'Username'		=> $this->input->post('user'),
			'PassUser'		=> sha1(md5($this->input->post('pass')))
			);

		$this->db->insert('m_user',$data);
	}

	public function get_data($id)
	{
		$query = $this->db->query("SELECT * FROM m_user WHERE ID_user = $id ");
		return $query;
	}

	public function update_data($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function hapus_data($id)
    {
        $this->db->where('ID_user',$id);
        $this->db->delete('m_user');
    }

    public function hapus_temp()
    {
    	$query = $this->db->query("DELETE FROM import_user_temp");
    	return $query;
    }
}
 ?>