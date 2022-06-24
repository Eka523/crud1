<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GetData extends CI_Controller {

	public function getKetApp()
	{
		$data = $this->query->getData('*', 'idapp', NULL)->result();
		echo json_encode($data);
	}

	public function getKetTPQ()
	{
		$data = $this->query->getData('*', 'idtpq', NULL)->result();
		echo json_encode($data);
	}

	public function getPD()
	{
		$data = $this->query->getData('*', 'pd', ['deleted_pd' => FALSE])->result();
		echo json_encode($data);
	}

	public function getGuru()
	{
		$data = $this->query->getData('*', 'guru', ['deleted_guru' => FALSE])->result();
		echo json_encode($data);
	}

	public function getKat()
	{
		$data = $this->query->getData('*', 'kat', ['jenis' => 'i'])->result();
		echo json_encode($data);
	}

	public function getKatO()
	{
		$data = $this->query->getData('*', 'kat', ['jenis' => 'o'])->result();
		echo json_encode($data);
	}

	public function getI()
	{
		$data = $this->query->getData('SUM(total_bayar) AS income', 'i')->result();
		echo json_encode($data);
	}

	public function getO()
	{
		$data = $this->query->getData('SUM(total_bayar) AS outcome', 'o')->result();
		echo json_encode($data);
	}

}

/* End of file GetData.php */