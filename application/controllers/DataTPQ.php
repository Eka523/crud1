<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataTPQ extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{
		$data = [
			'title'   => 'Dashboard',
			'url'     => 'dashboard',
			'content' => 'view_datatpq'
		];

		$this->load->view('layout/index', $data, FALSE);		
	}

	public function updateFotoSekolah()
	{
		$this->load->helper("url");

		$id_identitas = 1;

		$where = ['id_identitas' => $id_identitas];

		$data  = $this->query->getData('*', 'identitas', $where)->row();

		$filelama = $data->preview_sekolah;

		unlink($filelama);

		$filename = $_FILES['file']['name'];

		$location = 'uploads/'.time().$filename;

		$file_extension = pathinfo($location, PATHINFO_EXTENSION);
		$file_extension = strtolower($file_extension);

		$image_ext = array("jpg","png","jpeg","gif");

		$response = 0;
		if(in_array($file_extension,$image_ext)){
			if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
				$response = $location;
			}
		}

		$data1 = [
			'preview_sekolah' => $location
		];

		$table  = ['column' => 'id_identitas', 'param' => $id_identitas, 'table' => 'identitas'];
		$update = $this->query->update($table, $data1);

		echo $response;
	}

	public function updateLogoTPQ()
	{
		$this->load->helper("url");

		$where = ['id' => 1];

		$data  = $this->query->getData('*', 'idtpq', $where)->row();

		$filelama = $data->logo_tpq;

		unlink($filelama);

		$filename = $_FILES['file']['name'];

		$location = 'uploads/'.time().$filename;

		$file_extension = pathinfo($location, PATHINFO_EXTENSION);
		$file_extension = strtolower($file_extension);

		$image_ext = array("jpg","png","jpeg","gif");

		$response = 0;
		if(in_array($file_extension,$image_ext)){
			if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
				$response = $location;
			}
		}

		$data1 = [
			'logo_tpq' => $location
		];

		$table  = ['column' => 'id', 'param' => 1, 'table' => 'idtpq'];
		$update = $this->query->update($table, $data1);

		echo $response;
	}

	public function updateData()
	{
		$data = [
			'kepala_tpq' => $this->input->post('kepala_tpq1'),
			'nama_tpq' => $this->input->post('nama_tpq1'),
			'nspp' => $this->input->post('nspp1'),
			'alamat_tpq' => $this->input->post('alamat_tpq1'),
			'telp_tpq' => $this->input->post('telp_tpq1')
		];

		$table  = ['column' => 'id', 'param' => 1, 'table' => 'idtpq'];
		$update = $this->query->update($table, $data);
		if($update) {
			$response['ping'] = 200;
		} else {
			$response['ping'] = 500;
		}

		echo json_encode($response);
	}

}

/* End of file DataTPQ.php */
/* Location: ./application/controllers/DataTPQ.php */