<?php 

/**
 * 
 */
class home extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_transaksi');
		$this->load->model('m_kategori');
	}

	public function index()
	{
		$data['kategori'] = $this->m_kategori->lihat_data();
		$this->load->view('transaksi/form_input_umum',$data);
	}
}
 ?>