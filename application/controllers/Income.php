<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Income extends CI_Controller {

	public function index()
	{
		$data = [
			'title'   => 'Income',
			'url'     => 'Income',
			'header' => 'Lihat Data Income',
			'content' => 'view_income'
		];		

		$this->load->view('layout/index', $data, FALSE);
	}

	public function loadTable()
	{
		$select = '*';
		$table  = 'i';

		$limit = [
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		];

		$like['data'][] = [
			'column' => 'id_i, nomor_induk, nama, ket, total_bayar, time',
			'param'  => $this->input->get('search[value]')
		];

		$indexOrder = $this->input->get('order[0][column]');
		$order['data'][] = [
			'column' => $this->input->get('columns['.$indexOrder.'][name]'),
			'type'   => $this->input->get('order[0][dir]')
		];

		$join['data'][] = [
			'table' => 'pd',
			'key'   => 'i.id_pd = pd.id_pd',
			'type'  => 'inner'
		];

		$join['data'][] = [
			'table' => 'guru',
			'key'   => 'guru.id_guru = pd.id_guru',
			'type'  => 'inner'
		];

		$join['data'][] = [
			'table' => 'kat',
			'key'   => 'i.id_kat = kat.id_kat',
			'type'  => 'inner'
		];

		$totalData  = $this->query->dataComplete($select, $table, NULL, NULL, NULL, $join, NULL);
		$filterData = $this->query->dataComplete($select, $table, NULL, $like, $order, $join, NULL);
		$queryData  = $this->query->dataComplete($select, $table, $limit, $like, $order, $join, NULL);

		$result['data'] = [];
		if($queryData <> FALSE) {
			$no = $limit['start'] + 1;

			foreach($queryData->result() as $query) {
				if($query->id_i > 0) {
					$result['data'][] = [
						$no,
						$query->nomor_induk,
						$query->nama,
						$query->nama_guru,
						$query->ket,
						$query->total_bayar,
						$query->time,
						'
						<button onclick="cetak_nota('.$query->id_i.')" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-print"></i></button>
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

}

/* End of file Kelas.php */
/* Location: ./application/controllers/Kelas.php */