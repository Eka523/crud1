<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'assets/vendor/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class CetakNota extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{	

		$id_i=$_GET['id_i'];

		$select = '*';
		$table  = 'i';

		$limit = [
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		];

		$like['data'][] = [
			'column' => 'id_i, nomor_induk, nama, nama_guru, ket, total_bayar, time',
			'param'  => $this->input->get('search[value]')
		];

		$indexOrder = $this->input->get('order[0][column]');
		$order['data'][] = [
			'column' => $this->input->get('columns['.$indexOrder.'][name]'),
			'type'   => $this->input->get('order[0][dir]')
		];

		$where['data'][] = [
			'column' => 'id_i',
			'param'  => $id_i
		];

		$join['data'][] = [
			'table' => 'pd',
			'key'   => 'i.id_pd = pd.id_pd',
			'type'  => 'inner'
		];

		$join['data'][] = [
			'table' => 'guru',
			'key'   => 'pd.id_guru = guru.id_guru',
			'type'  => 'inner'
		];

		$join['data'][] = [
			'table' => 'kat',
			'key'   => 'i.id_kat = kat.id_kat',
			'type'  => 'inner'
		];

		$totalData  = $this->query->dataComplete($select, $table, NULL, NULL, NULL, $join, $where);
		$filterData = $this->query->dataComplete($select, $table, NULL, $like, $order, $join, $where);
		$queryData  = $this->query->dataComplete($select, $table, $limit, $like, $order, $join, $where);


		$qtpq = $this->query->getData('*', 'idtpq', NULL)->row();	

		$qi = $queryData->row();

		try {
			$connector = new WindowsPrintConnector("printerku");
			
			$printer = new Printer($connector);
			
			$printer -> selectPrintMode(Printer::MODE_FONT_B);
			$printer -> setJustification(Printer::JUSTIFY_CENTER);
			$printer -> text($qtpq->nama_tpq."\n");

			$printer -> selectPrintMode();
			$printer -> setJustification();

			$printer -> setJustification(Printer::JUSTIFY_CENTER);
			$printer -> text($qtpq->alamat_tpq."\n");
			$printer -> text("NSPP : ".$qtpq->nspp."\n\n\n");

			$printer -> setJustification();

			$printer -> setJustification(Printer::JUSTIFY_LEFT);
			$printer -> text("Kami telah menerima pembayaran : \n");
			$printer -> text("Nama : ".$qi->nama."\n");
			$printer -> text("Nomor Induk : ".$qi->nomor_induk."\n");
			$printer -> text("Nama Guru : ".$qi->nama_guru."\n");
			$printer -> text("Nominal : ".$qi->total_bayar."\n");
			$printer -> text("Pada : ".$qi->time."\n");
			$printer -> text("Untuk Pembayaran : ".$qi->ket."\n\n\n");

			$printer -> setJustification();

			$printer -> setJustification(Printer::JUSTIFY_CENTER);
			$printer -> text("Alhamdulillah, Terima kasih\n");

			$printer -> setJustification();

			$printer -> cut();

			/* Close printer */
			
			$printer -> close();
		} catch (Exception $e) {
			echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
		}

		redirect('Income');

	}

}

/* End of file DataTPQ.php */
/* Location: ./application/controllers/DataTPQ.php */