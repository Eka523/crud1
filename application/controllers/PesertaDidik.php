<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PesertaDidik extends CI_Controller {

	public function index()
	{
		$data = [
			'title'   => 'Peserta Didik',
			'url'     => 'peserta didik',
			'header' => 'Kelola Data Peserta Didik',
			'content' => 'view_pd'
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

		$join['data'][] = [
			'table' => 'guru',
			'key'   => 'guru.id_guru = pd.id_guru',
			'type'  => 'inner'
		];

		$totalData  = $this->query->dataComplete($select, $table, NULL, NULL, NULL, $join, $where);
		$filterData = $this->query->dataComplete($select, $table, NULL, $like, $order, $join, $where);
		$queryData  = $this->query->dataComplete($select, $table, $limit, $like, $order, $join, $where);

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
						$query->nama_guru,
						$ketgender,
						'
						<button onclick="showData('.$query->id_pd.')" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-edit"></i></button>
						<button onclick="deleted('.$query->id_pd.')" class="btn btn-danger btn-circle btn-sm" title="Delete Data"><i class="fa fa-trash"></i></button>
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
					'nomor_induk' => $this->input->post('nomor_induk'),
					'nama' => $this->input->post('nama'),
					'id_guru' => $this->input->post('id_guru'),
					'jk' => $this->input->post('jk')
		];

		$insert = $this->query->insert('pd', $data);
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
			'nomor_induk' => $this->input->post('nomor_induk'),
			'nama' => $this->input->post('nama'),
			'id_guru' => $this->input->post('id_guru'),
			'jk' => $this->input->post('jk')
		];

		$table  = ['column' => 'id_pd', 'param' => $id, 'table' => 'pd'];
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
		$table      = ['column' => 'id_pd', 'param' => $id, 'table' => 'pd'];
		$deleteData = $this->query->update($table, $data);
		if($deleteData) {
			$response['ping'] = 200;
		} else {
			$response['ping'] = 500;
		}

		echo json_encode($response);
	}

}

/* End of file PesertaDidik.php */
/* Location: ./application/controllers/PesertaDidik.php */