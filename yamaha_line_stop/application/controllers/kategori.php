<?php 

/**
 * 
 */
class kategori extends CI_Controller
{
	
	function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('m_kategori');
	}

	//================================kategori

	public function index()
	{
		$user = $this->session->userdata('ses_IdUser');
		if ($user=="") {
			redirect('login');
		}else{
		$data['kategori'] = $this->m_kategori->lihat_data();
		$this->load->view('template/header');
		$this->load->view('kategori/index',$data);
		$this->load->view('template/footer');
		}
	}

	public function pilih_kategori()
	{
		$tiketID = $_GET['id'];

		$this->db->where('ID_Kategori', $tiketID);
		$query = $this->db->get('m_kategori');

		echo "<select class='form-control' name='detail_kategori' required>";

		if ($query->num_rows() > 0) {
			$kategori   = $this->db->get_where('detail_kategori',array('ID_Kategori'=>$tiketID));
			
	        foreach ($kategori->result() as $k)
	        {
	        	echo "
						<option value='$k->ID_DetailKategori'>$k->NamaDetailKategori</option>
						";
	        }
	        
		}else{
				echo "<option></option>";
		}
		echo "</select>";        
	}

	public function newKategori()
	{
		$data['baru'] 	= '1';
		$this->load->view('template/header');
		$this->load->view('kategori/form',$data);
		$this->load->view('template/footer');
	}

	public function simpan()
	{
		if (isset($_POST)) {
			$this->m_kategori->simpan_data();
			$this->session->set_flashdata('msg',
						'<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                                Berhasil Menyimpan
						</div>');
			redirect('kategori');
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
	            $data['kategori'] = $this->m_kategori->get_data($id);
	            $data['baru'] = '';         
				$this->load->view('template/header');
				$this->load->view('kategori/form',$data);
				$this->load->view('template/footer');
	        }else{
	        	echo "no";
	        }
		}
	}

	public function update()
	{
		$id 		= $this->input->post('id');
		$kategori 	= $this->input->post('kategori');

		$data = array(
			'NamaKategori'		=> $kategori
			);

		$where = array(
			'ID_Kategori' 	=> $id
			);

		$this->m_kategori->update_data($where,$data,'m_kategori');

		$this->session->set_flashdata('msg',
				'<div class="alert alert-info alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Mengubah
				</div>');
		redirect('kategori');
	}

	public function hapus()
	{
		$id = $this->input->post('id');
        $this->m_kategori->hapus_data($id);

        $this->session->set_flashdata('msg',
				'<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Menghapus
				</div>');
        redirect('kategori');
	}

	//=========================detail kategori

	public function detail_kategori()
	{
		$user = $this->session->userdata('ses_IdUser');
		if ($user=="") {
			redirect('login');
		}else{
			if (isset($_GET['us'])) {
				$id = $_GET['us'];
				$data['idnya'] 		= $id;
				$data['kategori'] 	= $this->m_kategori->get_data($id);
				$data['detail'] 	= $this->m_kategori->lihat_detail($id);
				$this->load->view('template/header');
				$this->load->view('kategori/detail_kategori',$data);
				$this->load->view('template/footer');
			}else{
				echo "no";
			}		
		}
	}

	public function newDetail()
	{
		$user = $this->session->userdata('ses_IdUser');
		if ($user=="") {
			redirect('login');
		}else{
			if (isset($_GET['us'])) {

				$data['kategori'] = $_GET['us'];
				$data['baru'] 	= '1';
				$this->load->view('template/header');
				$this->load->view('kategori/form_detail',$data);
				$this->load->view('template/footer');
			}
		}		
	}

	public function simpanDetail()
	{
		if (isset($_POST)) {
			$this->m_kategori->simpan_detail();
			$this->session->set_flashdata('msg',
						'<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                                Berhasil Menyimpan
						</div>');
			// redirect('kategori');
			redirect('./kategori/detail_kategori?us='.$_POST[kategori].'');
		}
	}

	public function getDetail()
	{
		$user = $this->session->userdata('ses_IdUser');
		if ($user == "") {
			redirect('login');
		}else{
			if (isset($_GET['us']) ) {
				$id 				= $_GET['us']; 
	            $data['baru'] 		= ''; 
	            $data['detail'] 	= $this->m_kategori->get_data_detail($id);
	            $data['details'] 	= $this->m_kategori->get_data_details($id);        
				$this->load->view('template/header');
				$this->load->view('kategori/form_detail',$data);
				$this->load->view('template/footer');
	        }else{
	        	echo "no";
	        }
		}
	}

	public function updatedetail()
	{
		$id 		= $this->input->post('id');
		$kategori 	= $this->input->post('kategori');
		$detail 	= $this->input->post('detail');

		$data = array(
			'ID_Kategori'			=> $kategori,
			'NamaDetailKategori' 	=> $detail
			);

		$where = array(
			'ID_DetailKategori' 	=> $id
			);

		$this->m_kategori->update_data($where,$data,'detail_kategori');

		$this->session->set_flashdata('msg',
				'<div class="alert alert-info alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Mengubah
				</div>');
		redirect('./kategori/detail_kategori?us='.$_POST[kategori].'');
	}

	public function hapusDetail()
	{
		$id = $this->input->post('id');
        $this->m_kategori->hapus_detail($id);

        $this->session->set_flashdata('msg',
				'<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Menghapus
				</div>');
        redirect('./kategori/detail_kategori?us='.$_POST[kategori].'');
	}


}
 ?>