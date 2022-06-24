<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

	public function index()
	{
		$data = [
			'title'   => 'Siswa',
			'url'     => 'Siswa',
			'header' => 'Kelola Data Siswa',
			'content' => 'view_siswa'
		];		

		$this->load->view('layout/index', $data, FALSE);
	}

	public function loadTable()
	{
		$select = '*';
		$table  = 'siswa';

		$limit = [
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		];

		$like['data'][] = [
			'column' => 'id_siswa, nama_siswa, alamat',
			'param'  => $this->input->get('search[value]')
		];

		$indexOrder = $this->input->get('order[0][column]');
		$order['data'][] = [
			'column' => $this->input->get('columns['.$indexOrder.'][name]'),
			'type'   => $this->input->get('order[0][dir]')
		];

		

		$totalData  = $this->query->dataComplete($select, $table, NULL, NULL, NULL, NULL, NULL);
		$filterData = $this->query->dataComplete($select, $table, NULL, $like, $order, NULL, NULL);
		$queryData  = $this->query->dataComplete($select, $table, $limit, $like, $order, NULL, NULL);

		$result['data'] = [];
		if($queryData <> FALSE) {
			$no = $limit['start'] + 1;

			foreach($queryData->result() as $query) {
				if($query->id_siswa > 0) {
					$result['data'][] = [
						$no,
						$query->nama_siswa,
						$query->alamat,
						'
						<button onclick="showData('.$query->id_siswa.')" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-edit"></i></button>
						<button onclick="deleted('.$query->id_siswa.')" class="btn btn-danger btn-circle btn-sm" title="Delete Data"><i class="fa fa-trash"></i></button>
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
		$where = ['id_siswa' => $id];
		$data  = $this->query->getData('*', 'siswa', $where)->row();
		echo json_encode($data);
	}

	public function insertData()
	{
		$data = [
				'nama_siswa' => $this->input->post('nama_siswa'),
				'alamat' => $this->input->post('alamat')
		];

		$insert = $this->query->insert('siswa', $data);
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
			'nama_siswa' => $this->input->post('nama_siswa'),
			'alamat' => $this->input->post('alamat')
		];

		$table  = ['column' => 'id_siswa', 'param' => $id, 'table' => 'siswa'];
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
		
		$where = [
			'id_siswa' => $id
		];

		$deleteData = $this->query->delete('siswa', $where);
		if($deleteData) {
			$response['ping'] = 200;
		} else {
			$response['ping'] = 500;
		}

		echo json_encode($response);
	}

}

/* End of file Guru.php */
/* Location: ./application/controllers/Guru.php */