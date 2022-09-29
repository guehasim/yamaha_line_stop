<?php 

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx; 

class Transaksi extends CI_Controller
{
	
	function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->library('upload');
		$this->load->model('m_transaksi');
		$this->load->model('m_karyawan');
		$this->load->model('m_kategori');
	}

	public function index()
	{
		$user = $this->session->userdata('ses_IdUser');
		if ($user=="") {
			redirect('login');
		}else{
			$status = $this->session->userdata('ses_StatusUser');

			if ($status == 0) {
				$data['transaksi'] = $this->m_transaksi->lihat_admin();
				$this->load->view('template/header');
				$this->load->view('transaksi/index',$data);
				$this->load->view('template/footer');
			}else{
				$id = $this->session->userdata('ses_IdUser');
				$data['transaksi'] = $this->m_transaksi->lihat_karyawan($id);
				$this->load->view('template/header');
				$this->load->view('transaksi/index',$data);
				$this->load->view('template/footer');
			}
		}		
	}

	public function get_autocomplete(){
        if (isset($_GET['term'])) {
			$result = $this->m_transaksi->get_karyawan($_GET['term']);
			if (count($result) > 0) {
				foreach ($result as $row) {
					$arr_result[] = $row->NikUser;
					echo json_encode($arr_result);
				}
			}
		}
    }

    function search(){
        $title=$this->input->post('nik_pilih');
        $data['data']=$this->m_transaksi->get_karyawan($title);
 
        $this->load->view('transaksi/form',$data);
    }

	public function newTransaksi()
	{
		$id = $this->session->userdata('ses_IdUser');
		$data['karyawan'] = $this->m_karyawan->get_data($id);
		$data['kategori'] = $this->m_kategori->lihat_data();
		$data['baru'] = '1';
		$this->load->view('template/header');
		$this->load->view('transaksi/form',$data);
		$this->load->view('template/footer');

	}

	public function simpan()
	{
		$config['upload_path'] = 'assets/upload/files/'; //path folder
        $config['allowed_types'] = 'xls|xlsx|doc|docx|pdf'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload

        $form = $this->input->post('jenis_form');

        $nik = $this->input->post('nik');
        $this->db->where('NikUser',$nik);
        $query_cek = $this->db->get('m_user');

        if ($query_cek->num_rows() > 0) {
        	$row = $query_cek->row();

        	$this->upload->initialize($config);
	        if(!empty($_FILES['image']['name'])){
	 
	            if ($this->upload->do_upload('image')){
	                $gbr = $this->upload->data();
	                //Compress Image
	                $config['size']= 2000;
	                $this->load->library('image_lib', $config);

	                $gambar=$gbr['file_name'];
	                // echo "Image berhasil diupload";

	                if (isset($_POST)) {
	                	$this->m_transaksi->simpan_data($gambar);
	                	$this->session->set_flashdata('msg',
							'<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			                                Berhasil Menyimpan
							</div>');

	                	if ($form == 1) {
	                		redirect('home');
	                	}else{
	                		redirect('transaksi');
	                	}

	                	// echo "Simpan";
						
	                }else{
	                	$this->session->set_flashdata('msg',
							'<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			                                Gagal Dalam upload File!!
							</div>');
	            		redirect('transaksi');
	                }

	            }else{
	            	$this->session->set_flashdata('msg',
							'<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			                                Gagal Dalam upload File!!
							</div>');
	            	redirect('transaksi');
	            }
	                      
	        }else{
	            $this->session->set_flashdata('msg',
							'<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			                                Gagal Dalam upload File, Ekstensi Tidak Sesuai dengan ketentuan !!
							</div>');
	            redirect('transaksi');
	        }
        }else{
        	$this->session->set_flashdata('msg',
							'<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			                                Nik tidak ada di database !!
							</div>');
        		redirect('transaksi');
        }
        
	}

	public function get_action()
	{
		$user = $this->session->userdata('ses_IdUser');
		if ($user == "") {
			redirect('login');
		}else{
			if (isset($_GET['us']) ) {
	            $id = $_GET['us'];
	            $data['tiket'] = $this->m_transaksi->get_data($id);
	            $data['baru'] = '';         
				$this->load->view('template/header');
				$this->load->view('transaksi/form_action',$data);
				$this->load->view('template/footer');
	        }else{
	        	echo "no";
	        }
		}
	}

	public function simpan_action()
	{
		$id 		= $this->input->post('id_transaksi');
		$aksi 		= $this->input->post('aksi');
		$tanggal 	= $this->input->post('tanggal_now');

		$config['upload_path'] = 'assets/upload/files/'; //path folder
        $config['allowed_types'] = 'xls|xlsx|doc|docx|pdf'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
 
        $this->upload->initialize($config);
        if(!empty($_FILES['image']['name'])){
 
            if ($this->upload->do_upload('image')){
                $gbr = $this->upload->data();
                //Compress Image
                $config['size']= 2000;
                $this->load->library('image_lib', $config);

                $gambar=$gbr['file_name'];
                // echo "Image berhasil diupload";

                if (isset($_POST)) {
                	
                	$data = array(
                		'TglNow' 		=> date('Y-m-d',strtotime($tanggal)),
						'TransStatus' 	=> 1,
						'Action'		=> $aksi,
						'DocAfter'		=> $gambar
						);

					$where = array(
						'ID_Transaksi' 			=> $id
						);

					$this->m_transaksi->update_data($where,$data,'tbl_transaksi');

                	$this->session->set_flashdata('msg',
						'<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                                Berhasil Menyimpan Action
						</div>');
					redirect('transaksi');
                }

            }
                      
        }else{
            echo "Dokument yang diupload kosong";
        }
	}

	public function get_update()
	{
		$user = $this->session->userdata('ses_IdUser');
		if ($user == "") {
			redirect('login');
		}else{
			if (isset($_GET['us']) ) {
	            $ids = $_GET['us'];
	            $id = $this->session->userdata('ses_IdUser');
				$data['karyawan'] = $this->m_karyawan->get_data($id);
				$data['kategori'] = $this->m_kategori->lihat_data();
	            $data['transaksi'] = $this->m_transaksi->get_data($ids);
	            $data['baru'] = '';         
				$this->load->view('template/header');
				$this->load->view('transaksi/form',$data);
				$this->load->view('template/footer');
	        }else{
	        	echo "no";
	        }
		}
	}

	public function update()
	{
		$id 			= $this->input->post('id_transaksi');
		$tgl_now 		= date('Y-m-d',strtotime($this->input->post('tanggal_now')));
		$tgl_begin 		= date('Y-m-d',strtotime($this->input->post('tanggal_begin')));
		$tgl_after 		= date('Y-m-d',strtotime($this->input->post('tanggal_after')));

		$nik 			= $this->input->post('nik');
		$detail_kategori= $this->input->post('detail_kategori');
		$deskripsi 		= $this->input->post('deskripsi');

		$config['upload_path'] = 'assets/upload/files/'; //path folder
        $config['allowed_types'] = 'xls|xlsx|doc|docx|pdf'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload

        $this->db->where('NikUser',$nik);
        $query_cek = $this->db->get('m_user');

        if ($query_cek->num_rows() > 0) {
        	$row = $query_cek->row();
        	$id_karyawan = $row->ID_User;
        	$this->upload->initialize($config);
	        if(!empty($_FILES['image']['name'])){
	 
	            if ($this->upload->do_upload('image')){
	                $gbr = $this->upload->data();
	                //Compress Image
	                $config['size']= 2000;
	                $this->load->library('image_lib', $config);

	                $gambar=$gbr['file_name'];
	                // echo "Image berhasil diupload";

	                if (isset($_POST)) {

	                	$data = array(
							'TglNow' 				=> $tgl_now,
							'TglBegin'				=> $tgl_begin,
							'TglAfter'				=> $tgl_after,
							'ID_User' 				=> $id_karyawan,
							'ID_DetailKategori' 	=> $detail_kategori,
							'Deskripsi' 			=> $deskripsi,
							'DocBegin' 				=> $gambar
							);

						$where = array(
							'ID_Transaksi' 			=> $id
							);

						$this->m_transaksi->update_data($where,$data,'tbl_transaksi');

						$this->session->set_flashdata('msg',
								'<div class="alert alert-info alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				                                Berhasil Mengubah
								</div>');
						redirect('transaksi');
	                }

	            }
	                      
	        }else{
	            $data = array(
							'TglNow' 				=> $tgl_now,
							'TglBegin'				=> $tgl_begin,
							'TglAfter'				=> $tgl_after,
							'ID_User' 				=> $id_karyawan,
							'ID_DetailKategori' 	=> $detail_kategori,
							'Deskripsi' 			=> $deskripsi
							);

						$where = array(
							'ID_Transaksi' 			=> $id
							);

						$this->m_transaksi->update_data($where,$data,'tbl_transaksi');

						$this->session->set_flashdata('msg',
								'<div class="alert alert-info alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				                                Berhasil Mengubah
								</div>');
						redirect('transaksi');
	        }

        }else{
        	$this->session->set_flashdata('msg',
							'<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			                                NIK Salah
							</div>');
			redirect('transaksi');
        }
		
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
        $this->m_transaksi->hapus_data($id);

        $this->session->set_flashdata('msg',
				'<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Menghapus
				</div>');
        redirect('transaksi');
	}

	public function laporan()
	{
		$user = $this->session->userdata('ses_IdUser');
		if ($user == "") {
			redirect('login');
		}else{
			
			$period_awal  		= date('Y-m-d',strtotime($this->input->post('period_awal')));
			$period_akhir 		= date('Y-m-d',strtotime($this->input->post('period_akhir')));
			$status_laporan 	= $this->input->post('status_transaksi');

			$submit = $this->input->post('submitdata');			

			if ($submit == 'Reset') {

				redirect('transaksi');

			}else if($submit == 'Print'){

				$data['period_awal'] = date('d-m-Y',strtotime($this->input->post('period_awal')));
				$data['period_akhir'] = date('d-m-Y',strtotime($this->input->post('period_akhir')));
				$data['cetak'] = $this->m_transaksi->lihat_pdf($period_awal,$period_akhir,$status_laporan);
				$this->load->view('transaksi/cetak_my_live',$data);

			}else if($submit == 'Excel'){

				$data['period_awal'] = date('d-m-Y',strtotime($this->input->post('period_awal')));
				$data['period_akhir'] = date('d-m-Y',strtotime($this->input->post('period_akhir')));

				$semua_pengguna = $this->m_transaksi->lihat_pdf($period_awal,$period_akhir,$status_laporan);

				$spreadsheet = new Spreadsheet;

		          $spreadsheet->setActiveSheetIndex(0)
		                      ->setCellValue('A1', 'NO')
		                      ->setCellValue('B1', 'KATEGORI')
		                      ->setCellValue('C1', 'DETAIL KATEGORI')
		                      ->setCellValue('D1', 'PERIODE')
		                      ->setCellValue('E1', 'TANGGAL BEGIN')
		                      ->setCellValue('F1', 'TANGGAL AFTER')
		                      ->setCellValue('G1', 'NIK')
		                      ->setCellValue('H1', 'NAMA')
		                      ->setCellValue('I1', 'DEPARTEMENT')
		                      ->setCellValue('J1', 'DESKRIPSI')
		                      ->setCellValue('K1', 'ACTION');

		          $kolom = 2;
		          $nomor = 1;
		          foreach($semua_pengguna->result() as $pengguna) {

		               $spreadsheet->setActiveSheetIndex(0)
		                           ->setCellValue('A' . $kolom, $nomor)
		                           ->setCellValue('B' . $kolom, $pengguna->NamaKategori)
		                           ->setCellValue('C' . $kolom, $pengguna->NamaDetailKategori)
		                           ->setCellValue('D' . $kolom, date('d M y',strtotime($pengguna->TglNow)))
		                           ->setCellValue('E' . $kolom, date('d M y',strtotime($pengguna->TglBegin)))
		                           ->setCellValue('F' . $kolom, date('d M y',strtotime($pengguna->TglAfter)))
		                           ->setCellValue('G' . $kolom, $pengguna->NikUser)
		                           ->setCellValue('H' . $kolom, $pengguna->NamaUser)
		                           ->setCellValue('I' . $kolom, $pengguna->DeptUser)
		                           ->setCellValue('J' . $kolom, $pengguna->Deskripsi)
		                           ->setCellValue('K' . $kolom, $pengguna->Action);

		               $kolom++;
		               $nomor++;

		          }

		          $writer = new Xlsx($spreadsheet);

		          header('Content-Type: application/vnd.ms-excel');
			  header('Content-Disposition: attachment;filename="Laporan Line Stop.xls"');
			  header('Cache-Control: max-age=0');

			  $writer->save('php://output');
			}else if($submit == 'Search'){
				$data['period_awal'] = date('d-m-Y',strtotime($this->input->post('period_awal')));
				$data['period_akhir'] = date('d-m-Y',strtotime($this->input->post('period_akhir')));
				

				$data['transaksi'] = $this->m_transaksi->lihat_pdf($period_awal,$period_akhir,$status_laporan);

				$this->load->view('template/header');
				$this->load->view('transaksi/index',$data);
				$this->load->view('template/footer');
			}
			else{
				redirect('transaksi');
			}

		}
	}
}
 ?>