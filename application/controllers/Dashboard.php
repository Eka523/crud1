<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{
		$data = [
			'title'   => 'Dashboard',
			'url'     => 'dashboard',
			'content' => 'view_dashboard'
		];

		$this->load->view('layout/index', $data, FALSE);		
	}
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */