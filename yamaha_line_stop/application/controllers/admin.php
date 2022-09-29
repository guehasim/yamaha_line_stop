<?php 


class admin extends CI_Controller
{
	
	function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('m_admin');
	}

	public function index()
	{
		$user = $this->session->userdata('ses_IdUser');
		if ($user=="") {
			redirect('login');
		}else{
			$data['admin'] = $this->m_admin->lihat_data();
			$this->load->view('template/header');
			$this->load->view('admin/index',$data);
			$this->load->view('template/footer');
		}		
	}

	public function newAdmin()
	{
		$data['baru'] = '1';
		$this->load->view('template/header');
		$this->load->view('admin/form',$data);
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
			redirect('admin');
		}else{
			if (isset($_POST)) {
			$this->m_admin->simpan_data();
			$this->session->set_flashdata('msg',
						'<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                                Berhasil Menyimpan
						</div>');
			redirect('admin');
			}
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
	            $data['admin'] = $this->m_admin->get_data($id);
	            $data['baru'] = '';         
				$this->load->view('template/header');
				$this->load->view('admin/form',$data);
				$this->load->view('template/footer');
	        }else{
	        	echo "no";
	        }
		}
	}

	public function update()
	{
		$id 	= $this->input->post('id');
		$nama 	= $this->input->post('nama');
		$user 	= $this->input->post('user');

		$data = array(
			'NamaUser'		=> $nama,
			'StatusUser'	=> 1,
			'Username' 		=> $user
			);

		$where = array(
			'ID_User' 		=> $id
			);

		$this->m_admin->update_data($where,$data,'m_user');

		$this->session->set_flashdata('msg',
				'<div class="alert alert-info alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Mengubah
				</div>');
		redirect('admin');
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

		$this->m_admin->update_data($where,$data,'m_user');

		$this->session->set_flashdata('msg',
				'<div class="alert alert-info alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Mengubah
				</div>');
		redirect('admin');
	}

	public function delete()
	{
		$id = $this->input->post('id');
        $this->m_admin->hapus_data($id);

        $this->session->set_flashdata('msg',
				'<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Menghapus
				</div>');
        redirect('admin');
	}
}
 ?>