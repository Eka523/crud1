<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bayar extends CI_Controller {

	public function index()
	{
		$data = [
			'title'   => 'Pembayaran',
			'url'     => 'Bayar',
			'header' => 'Kelola Data Pembayaran',
			'content' => 'view_bayar'
		];		

		$this->load->view('layout/index', $data, FALSE);
	}

	public function loadTable()
	{
		$select = '*';
		$table  = 'pd';

		$limit = [
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		];

		$like['data'][] = [
			'column' => 'id_pd, nomor_induk, nama, jk',
			'param'  => $this->input->get('search[value]')
		];

		$indexOrder = $this->input->get('order[0][column]');
		$order['data'][] = [
			'column' => $this->input->get('columns['.$indexOrder.'][name]'),
			'type'   => $this->input->get('order[0][dir]')
		];

		$where['data'][] = [
			'column' => 'deleted_pd',
			'param'  => FALSE
		];

		$totalData  = $this->query->dataComplete($select, $table, NULL, NULL, NULL, NULL, $where);
		$filterData = $this->query->dataComplete($select, $table, NULL, $like, $order, NULL, $where);
		$queryData  = $this->query->dataComplete($select, $table, $limit, $like, $order, NULL, $where);

		$result['data'] = [];
		if($queryData <> FALSE) {
			$no = $limit['start'] + 1;

			foreach($queryData->result() as $query) {
				if($query->id_pd > 0) {
					$ketgender=0;
					if($query->jk=='p'){
						$ketgender = "Perempuan";
					}else{
						$ketgender = "Laki-laki";
					}
					$result['data'][] = [
						$no,
						$query->nomor_induk,
						$query->nama,
						$ketgender,
						'
						<button onclick="showData('.$query->id_pd.')" class="btn btn-success btn-circle btn-sm"><i class="fas fa-save"></i></button>
						'
					];
					$no++;
				}
			}
		}

		$result['recordsTotal'] = 0;
		if($totalData <> FALSE) {
			$result['recordsTotal'] = $totalData->num_rows();
		}

		$result['recordsFiltered'] = 0;
		if($filterData <> FALSE) {
			$result['recordsFiltered'] = $filterData->num_rows();
		}

		echo json_encode($result);
	}

	public function showData($id)
	{
		$where = ['id_pd' => $id];
		$data  = $this->query->getData('*', 'pd', $where)->row();
		echo json_encode($data);
	}

	public function insertData()
	{
		$data = [
					'id_pd' => $this->input->post('id_pd'),
					'id_kat' => $this->input->post('id_kat'),
					'total_bayar' => $this->input->post('total_bayar'),
					'time' => date("Y-m-d h:i:sa")
		];

		$insert = $this->query->insert('i', $data);
		if($insert) {
			$response['ping'] = 200;
		} else {
			$response['ping'] = 500;
		}

		echo json_encode($response);
	}

}

/* End of file Kelas.php */
/* Location: ./application/controllers/Kelas.php */