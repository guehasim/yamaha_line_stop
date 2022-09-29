<?php 


class karyawan extends CI_Controller
{
	
	function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('m_karyawan');
		$this->load->helper(array('url','html','form'));
	}

	public function index()
	{
		$user = $this->session->userdata('ses_IdUser');
		if ($user=="") {
			redirect('login');
		}else{
			$data['admin'] = $this->m_karyawan->lihat_data();
			$this->load->view('template/header');
			$this->load->view('karyawan/index',$data);
			$this->load->view('template/footer');
		}		
	}

	public function newAdmin()
	{
		$data['baru'] = '1';
		$this->load->view('template/header');
		$this->load->view('karyawan/form',$data);
		$this->load->view('template/footer');

	}

	public function newImport()
	{
		$this->load->view('template/header');
		$this->load->view('karyawan/import_data');
		$this->load->view('template/footer');
	}

	public function simpan()
	{
		$user = $this->input->post('user');

		$this->db->where('Username', $user);
		$query = $this->db->get('m_user');

		if ($query->num_rows() > 0) {
			$this->session->set_flashdata('msg',
						'<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                                Username sudah digunakan
						</div>');
			redirect('karyawan');
		}else{
			if (isset($_POST)) {
			$this->m_karyawan->simpan_data();
			$this->session->set_flashdata('msg',
						'<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                                Berhasil Menyimpan
						</div>');
			redirect('karyawan');
			}
		}		
	}

	public function pilih_id()
	{
		$nik = $_GET['id'];
        $niknya   = $this->db->get_where('m_user',array('NikUser'=>$nik,'StatusUser'=>'1'));
        foreach ($niknya->result() as $k)
        {
        	echo "<input type='hidden' name='karyawan' value='$k->ID_User' class='form-control'>";
        }
	}

	public function pilih_nama()
	{
		$nik = $_GET['id'];

		$this->db->where('NikUser', $nik);
		$this->db->where('StatusUser', '1');
		$query = $this->db->get('m_user');

		if ($query->num_rows() > 0) {
			$niknya   = $this->db->get_where('m_user',array('NikUser'=>$nik,'StatusUser'=>'1'));
	        foreach ($niknya->result() as $k)
	        {
	        	echo "<input type='text' value='$k->NamaUser' class='form-control' disabled>";       		
	        	
	        }
		}else{
			echo "<input type='text' class='form-control' disabled>";
		}        
	}

	public function pilih_dept()
	{
		$nik = $_GET['id'];

		$this->db->where('NikUser', $nik);
		$this->db->where('StatusUser', '1');
		$query = $this->db->get('m_user');

		if ($query->num_rows() > 0) {			
			$niknya   = $this->db->get_where('m_user',array('NikUser'=>$nik,'StatusUser'=>'1'));
	        foreach ($niknya->result() as $k)
	        {
	        	echo "<input type='text' value='$k->DeptUser' class='form-control' disabled>";
	        }
		}else{
			echo "<input type='text' class='form-control' disabled>";
		}        
	}

	public function get()
	{
		$user = $this->session->userdata('ses_IdUser');
		if ($user == "") {
			redirect('login');
		}else{
			if (isset($_GET['us']) ) {
	            $id = $_GET['us'];
	            $data['admin'] = $this->m_karyawan->get_data($id);
	            $data['baru'] = '';         
				$this->load->view('template/header');
				$this->load->view('karyawan/form',$data);
				$this->load->view('template/footer');
	        }else{
	        	echo "no";
	        }
		}
	}

	public function update()
	{
		$id 	= $this->input->post('id');
		$nik 	= $this->input->post('nik');
		$nama 	= $this->input->post('nama');
		$dept 	= $this->input->post('dept');
		$user 	= $this->input->post('user');

		$data = array(
			'NikUser'  		=> $nik,
			'NamaUser'		=> $nama,
			'DeptUser'		=> $dept,
			'StatusUser'	=> 1,
			'Username' 		=> $user
			);

		$where = array(
			'ID_User' 		=> $id
			);

		$this->m_karyawan->update_data($where,$data,'m_user');

		$this->session->set_flashdata('msg',
				'<div class="alert alert-info alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Mengubah
				</div>');
		redirect('karyawan');
	}

	public function update_password()
	{
		$id 	= $this->input->post('id');
		$pwd 	= sha1(md5($this->input->post('pass')));

		$data = array(
			'PassUser'  		=> $pwd,
			);

		$where = array(
			'ID_User' 		=> $id
			);

		$this->m_karyawan->update_data($where,$data,'m_user');

		$this->session->set_flashdata('msg',
				'<div class="alert alert-info alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Mengubah
				</div>');
		redirect('karyawan');
	}

	public function delete()
	{
		$id = $this->input->post('id');
        $this->m_karyawan->hapus_data($id);

        $this->session->set_flashdata('msg',
				'<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Menghapus
				</div>');
        redirect('karyawan');
	}
}
 ?>