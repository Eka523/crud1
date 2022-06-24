<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Outcome extends CI_Controller {

	public function index()
	{
		$data = [
			'title'   => 'Outcome',
			'url'     => 'Outcome',
			'header' => 'Lihat Data Outcome',
			'content' => 'view_outcome'
		];		

		$this->load->view('layout/index', $data, FALSE);
	}

	public function loadTable()
	{
		$select = '*';
		$table  = 'o';

		$limit = [
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		];

		$like['data'][] = [
			'column' => 'id_o, ket, total_bayar, time',
			'param'  => $this->input->get('search[value]')
		];

		$indexOrder = $this->input->get('order[0][column]');
		$order['data'][] = [
			'column' => $this->input->get('columns['.$indexOrder.'][name]'),
			'type'   => $this->input->get('order[0][dir]')
		];

		$join['data'][] = [
			'table' => 'kat',
			'key'   => 'o.id_kat = kat.id_kat',
			'type'  => 'inner'
		];

		$totalData  = $this->query->dataComplete($select, $table, NULL, NULL, NULL, $join, NULL);
		$filterData = $this->query->dataComplete($select, $table, NULL, $like, $order, $join, NULL);
		$queryData  = $this->query->dataComplete($select, $table, $limit, $like, $order, $join, NULL);

		$result['data'] = [];
		if($queryData <> FALSE) {
			$no = $limit['start'] + 1;

			foreach($queryData->result() as $query) {
				if($query->id_o > 0) {
					$result['data'][] = [
						$no,
						$query->ket,
						$query->total_bayar,
						$query->time
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

	public function insertData()
	{
		$data = [
					'id_kat' => $this->input->post('id_kat'),
					'total_bayar' => $this->input->post('total_bayar'),
					'time' => date("Y-m-d h:i:sa")
		];

		$insert = $this->query->insert('o', $data);
		if($insert) {
			$response['ping'] = 200;
		} else {
			$response['ping'] = 500;
		}

		echo json_encode($response);
	}

}





/* End of file Outcome.php */
/* Location: ./application/controllers/Outcome.php */