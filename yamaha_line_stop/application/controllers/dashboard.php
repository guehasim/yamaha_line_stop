<?php 

class dashboard extends CI_Controller
{

	function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('m_chart');
	}
	
	public function index()
	{
		$rows = $this->m_chart->get_data_open();
		$open = array();
		foreach($rows as $row){

			array_push($open, ["label" => date('d-M', strtotime($row->TglNow)), "y"=>$row->total]);
		}

		$rowx = $this->m_chart->get_data_close();
		$close = array();

		foreach ($rowx as $rsw) {
			array_push($close, ["label" => date('d-M', strtotime($rsw->TglNow)), "y"=>$rsw->total]);
		}

		$data['open'] = $open;
		$data['close'] = $close;

		$this->load->view('grafik/index',$data);
	}

}

?>