<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	public function index()
	{
		$data = [
			'title'   => 'Kategori',
			'url'     => 'Kategori',
			'header' => 'Kelola Data Kategori',
			'content' => 'view_kategori'
		];		

		$this->load->view('layout/index', $data, FALSE);
	}

	public function loadTable()
	{
		$select = '*';
		$table  = 'kat';

		$limit = [
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		];

		$like['data'][] = [
			'column' => 'id_kat, ket, jenis',
			'param'  => $this->input->get('search[value]')
		];

		$indexOrder = $this->input->get('order[0][column]');
		$order['data'][] = [
			'column' => $this->input->get('columns['.$indexOrder.'][name]'),
			'type'   => $this->input->get('order[0][dir]')
		];

		$where['data'][] = [
			'column' => 'deleted_kat',
			'param'  => FALSE
		];

		$totalData  = $this->query->dataComplete($select, $table, NULL, NULL, NULL, NULL, $where);
		$filterData = $this->query->dataComplete($select, $table, NULL, $like, $order, NULL, $where);
		$queryData  = $this->query->dataComplete($select, $table, $limit, $like, $order, NULL, $where);

		$result['data'] = [];
		if($queryData <> FALSE) {
			$no = $limit['start'] + 1;

			foreach($queryData->result() as $query) {
				if($query->id_kat > 0) {
					$ketjenis=0;
					if($query->jenis=='i'){
						$ketjenis = '<span class="badge badge-success">Income</span>';
					}else{
						$ketjenis = '<span class="badge badge-warning">Outcome</span>';
					}
					$result['data'][] = [
						$no,
						$query->ket,
						$ketjenis,
						'
						<button onclick="showData('.$query->id_kat.')" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-edit"></i></button>
						<button onclick="deleted('.$query->id_kat.')" class="btn btn-danger btn-circle btn-sm" title="Delete Data"><i class="fa fa-trash"></i></button>
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
		$where = ['id_kat' => $id];
		$data  = $this->query->getData('*', 'kat', $where)->row();
		echo json_encode($data);
	}

	public function insertData()
	{
		$data = [
					'ket' => $this->input->post('ket'),
					'jenis' => $this->input->post('jenis')
		];

		$insert = $this->query->insert('kat', $data);
		if($insert) {
			$response['ping'] = 200;
		} else {
			$response['ping'] = 500;
		}

		echo json_encode($response);
	}

	public function updateData($id)
	{
		$data = [
			'ket' => $this->input->post('ket'),
			'jenis' => $this->input->post('jenis')
		];

		$table  = ['column' => 'id_kat', 'param' => $id, 'table' => 'kat'];
		$update = $this->query->update($table, $data);
		if($update) {
			$response['ping'] = 200;
		} else {
			$response['ping'] = 500;
		}

		echo json_encode($response);
	}

	public function deleted($id)
	{
		$data       = ['deleted_pd' => TRUE];
		$table      = ['column' => 'id_kat', 'param' => $id, 'table' => 'kat'];
		$deleteData = $this->query->update($table, $data);
		if($deleteData) {
			$response['ping'] = 200;
		} else {
			$response['ping'] = 500;
		}

		echo json_encode($response);
	}

}

/* End of file Kelas.php */
/* Location: ./application/controllers/Kelas.php */