<?php 

/**
 * 
 */
class GoImport extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_karyawan');
	}

	public function index()
	{
		$this->m_karyawan->hapus_temp();
		redirect('Import');
	}
}
 ?>