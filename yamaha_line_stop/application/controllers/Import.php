<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Import extends CI_Controller {
// construct
public function __construct() {
parent::__construct();
// load model
	$this->load->model('Import_model', 'import_user_temp');
	$this->load->model('m_karyawan');
	$this->load->helper(array('url','html','form'));
}

public function index() {
		$data['user'] 	= $this->m_karyawan->lihat_temp();
		$this->load->view('template/header');
		$this->load->view('karyawan/import_data',$data);
		$this->load->view('template/footer');
}
public function importFile(){
	if ($this->input->post('submit')) {

			$path = 'uploads/';
			require_once APPPATH . "/third_party/PHPExcel.php";
			$config['upload_path'] = $path;
			$config['allowed_types'] = 'xlsx|xls|csv';
			$config['remove_spaces'] = TRUE;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('uploadFile')) {
			$error = array('error' => $this->upload->display_errors());
			} else {
			$data = array('upload_data' => $this->upload->data());
			}
			
			if(empty($error)){
				if (!empty($data['upload_data']['file_name'])) {
				$import_xls_file = $data['upload_data']['file_name'];
				} else {
				$import_xls_file = 0;
				}
				$inputFileName = $path . $import_xls_file;
				try {
					$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
					$objReader = PHPExcel_IOFactory::createReader($inputFileType);
					$objPHPExcel = $objReader->load($inputFileName);
					$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
					$flag = true;
					$i=0;
					foreach ($allDataInSheet as $value) {
						if($flag){
						$flag =false;
						continue;
						}
					$inserdata[$i]['ID_User_Temp'] 		= null;
					$inserdata[$i]['NikUser_Temp'] 		= $value['B'];
					$inserdata[$i]['NamaUser_Temp'] 	= $value['C'];
					$inserdata[$i]['DeptUser_Temp'] 	= $value['D'];
					$inserdata[$i]['Username_Temp'] 	= $value['E'];
					$inserdata[$i]['PassUser_Temp']		= sha1(md5($value['F']));
					$i++;
					}               
					$result = $this->import_user_temp->insert($inserdata);   
						if($result){

						$query_temp = $this->db->query("
							SELECT
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
							");
						foreach ($query_temp->result() as $ab) {
							$nik_temp 	= $ab->NikUser_Temp;
							$user_temp 	= $ab->Username_Temp;

							$nik 		= $ab->NikUser;
							$user 		= $ab->Username;							

							if ($nik_temp == '' && $user_temp == '') {
								// $this->session->set_flashdata('msg',
								// 	'<div class="alert alert-danger alert-dismissable">
								// 	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					   //                              Data Excel tidak ada !!
								// 	</div>');
							}else if($nik_temp != '' && $user_temp != '' && $nik == '' && $user == '' ){

								echo $nik_temp;
								
								$query_insert = $this->db->query("INSERT INTO m_user(NikUser,NamaUser,DeptUser,StatusUser,Username,PassUser) SELECT NikUser_Temp, NamaUser_Temp, DeptUser_Temp,'1',Username_Temp,PassUser_Temp FROM import_user_temp WHERE NikUser_Temp = '$nik_temp' ");

								// $this->session->set_flashdata('msg',
								// 	'<div class="alert alert-success alert-dismissable">
								// 	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					   //                              Berhasil Menyimpan
								// 	</div>');

							}else{
								// $this->session->set_flashdata('msg',
								// 	'<div class="alert alert-success alert-dismissable">
								// 	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					   //                              Berhasil Menyimpan
								// 	</div>');
							}

							// $query_ayo = $this->db->query("SELECT NikUser FROM m_user ");

							// foreach ($query_ayo->result() as $ac) {
							// 	$nik_cek = $ac->NikUser;
							// 	// echo $nik_cek;

							// 	if ($nik_cek != $nik_temp) {
							// 		echo "insert";
							// 	}else{
							// 		echo "blank";
							// 		$query_insert = $this->db->query("INSERT INTO m_user(NikUser,NamaUser,DeptUser,StatusUser,Username,PassUser) SELECT NikUser_Temp, NamaUser_Temp, DeptUser_Temp,'1',Username_Temp,PassUser_Temp FROM import_user_temp WHERE NikUser_Temp = '$nik_temp' ");
							// 		return $query_insert;
							// 	}
							// }
						}
						redirect('Import');
            		}else{
            			echo "ndak iso !!";
            		}
				} catch (Exception $e) {
				die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
				. '": ' .$e->getMessage());
				}
			}else{
			echo $error['error'];
			}
		}else{echo "tidak bisa import";}
		// redirect('karyawan');		
	}
}
?>