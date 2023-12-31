<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_barang extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("M_laporan_barang"); //load model
		if($this->session->userdata('status') != "login"){
			redirect(base_url("auth"));
		}
    }


	public function index()
	{
	
		$data['conf'] = $this->M_laporan_barang->config();
		$data['nama_user'] = $this->session->userdata('nama_user');
		$data['nama_menu'] = 'Mutasi Barang';
		$data['x_token'] = $this->session->userdata('x_token');
		$this->load->view('back_end/a_header',$data);
		$this->load->view('back_end/b_navbar',$data);
		$this->load->view('back_end/c_sidebar',$data);
		// $this->load->view('back_end/d_content',$data);
		$this->data();
		$this->load->view('back_end/e_footer',$data);
	}

	
	function data()  {
		// header('Content-Type: application/json');
		$where = array(
			'state' => 'aktif'
		);	
		$data['data'] = $this->M_laporan_barang->get_data('posisi_barang',$where);
		$this->load->view('back_end/d_content',$data);
		// echo json_encode($data);
	}




	//get form mutasi
	function mutasi($id)  {
		$where = array(
			'id_barang' => $id,
			'barang.state' => 'aktif'
		);	
		
		$data['barang'] = $this->M_laporan_barang->get_barang('barang',$where);
		$wheres = array(
		'state' => 'aktif'
		);
		$data['user'] = $this->M_laporan_barang->get_data('user',$wheres);
		$data['ruang'] = $this->M_laporan_barang->get_data('ruang',$wheres);
		$data['status_barang'] = $this->M_laporan_barang->get_data('status_barang',$wheres);
		
		$where_sebelum = array(
			'posisi_barang.state' => 'aktif',
			'id_barang'=> $id

		);
		$cek  =  $this->M_laporan_barang->get_sebelum('posisi_barang',$where_sebelum)->num_rows();

		$id_ruang_sebelum;
		$nama_ruang_sebelum;
		if($cek > 0){
			$ruang_sebelum  =  $this->M_laporan_barang->get_sebelum('posisi_barang',$where_sebelum)->result();
			// print_r($ruang_sebelum);
			$id_ruang_sebelum = $ruang_sebelum[0]->id_ruang_sesudah;
			$nama_ruang_sebelum = $ruang_sebelum[0]->nama_ruangan;
		}else{
			$id_ruang_sebelum = 1;
			$nama_ruang_sebelum = 'Belum Terdistribusi';
		}
		$data['id_ruang_sebelum'] = $id_ruang_sebelum;
		$data['nama_ruang_sebelum'] = $nama_ruang_sebelum;
		// print_r($data);
		$this->load->view('back_end/mutasi_content',$data);
	}
//get Content table
	function content()  {
		$where = array(
			'posisi_barang.state' => 'aktif'
		);	
		$data['data'] = $this->M_laporan_barang->get_posisi('posisi_barang',$where);
		$this->load->view('back_end/table_content',$data);
		// print_r($data);
	}

//restore		
	function data_sampah()  {
		$where = array(
			'state' => 'tidak'
		);	
		$data['data'] = $this->M_laporan_barang->get_data('laporan_barang',$where);
		$this->load->view('back_end/table_content_sampah',$data);
	}


//prosess add
	function add_p()  {
		
$id_user = $this->session->userdata('id_user');
$data = array(
	'id_barang' => $_POST['id_barang'],
	'id_user_create' => $id_user,
	'id_user_mutasi' => $_POST['id_user_mutasi'],
	'id_ruang_sesudah' => $_POST['id_ruang'],
	'id_status_barang' => $_POST['id_status_barang'],
	'keterangan' => $_POST['keterangan'],
	'id_ruang_sebelum' => $_POST['id_ruang_sebelum'],
	'state' => 'aktif',
	'tanggal_input_mutasi' => date('Y-m-d H:i:s')
);

// Hapus Dulu 
$where  = array(
	'id_barang' => $_POST['id_barang']
);
$update  = array(
	'state' => 'tidak',
);

 $this->M_laporan_barang->edit_data($where,$update,'posisi_barang');

	
	$respone  = array(
			'respone' => '200',
			'data' => 'Data Tersimpan!'
		);
//baru Isi
		$this->M_laporan_barang->input_data($data,'posisi_barang');

	 

	header('Content-Type: application/json');
	echo json_encode($respone);

	


	
	}
// get password
	function barang_qr(){
		$this->load->library('enc');
		$id_barang = $this->enc->out($_POST['qr']);

		$where = array(
			'kode_id_barang' => $id_barang,
			'barang.state' => 'aktif'
		);	


		$data = $this->M_laporan_barang->get_barang('barang',$where);
		$id_barang = $data[0]->id_barang;
		// $data['data']=$id_barang;

		$respone  = array(
			'respone' => '200',
			'data' => $id_barang
		);
// return $data;
		header('Content-Type: application/json');
		echo json_encode($respone);
	
	}


//proses edit
	function edit_p()  {
	
		$data = array(
		'nama_laporan_barang' => $_POST['nama_laporan_barang'],
	);	
	//cek before
	$where = array(
		'id_laporan_barang' => $_POST['id_laporan_barang']
	);

	
		$respone  = array(
			'respone' => '200',
			'data' => 'Data Tersimpan!'
		);

	  $insert = $this->M_laporan_barang->edit_data($where,$data,'laporan_barang');


	header('Content-Type: application/json');
	echo json_encode($respone);

	


	
	}




function menu_bar() {
	$this->load->view('back_end/menu_bar');
}


function content_barang()  {
	$where = array(
		'barang.state' => 'aktif'
	);	
	$data['data'] = $this->M_laporan_barang->get_barang('barang',$where);
	$this->load->view('back_end/table_content_barang',$data);
}


function qr_code2()  {
	$this->load->view('back_end/qr_content2');
}
  

function report()  {
	$where = array(
		
		
	);	
	$data['data'] = $this->M_laporan_barang->get_posisi('posisi_barang',$where);
	$this->load->view('back_end/table_content',$data);

}

function berita_acara($id)  {
	$where = array(
		'id_posisi_barang' => $id,
		'barang.state' => 'aktif'
	);	
	
	$data['barang'] = $this->M_laporan_barang->get_posisi_b('posisi_barang',$where);


	// $data['barang'] = $this->M_laporan_barang->get_barang('posisi_barang',$where);
	$data['conf'] = $this->M_laporan_barang->config();


	$this->load->library('pdfgenerator');
	$data['title'] = "Label";
	$file_pdf = $data['title'];
	$paper = 'A4';
	$orientation = "portrait";
	$html = $this->load->view('back_end/berita_acara', $data, true);
	$this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
	// $this->load->view('back_end/berita_acara', $data);
}

//Get Form
function laporan_distributor() {
	$where = array(
	'state' => 'aktif'	
	);

	$data['distributor']= $this->M_laporan_barang->get_data('distributor',$where);

	// print_r($data);
	$this->load->view('back_end/laporan_distributor',$data);

	// echo "OK";	
}
//Tabel Distributor
function tabel_distributor($id) {
	$where = array(
'barang.id_distributor' => $id,
'barang.state' => 'aktif',
'posisi_barang.state' => 'aktif'
	);

	$data['data'] = $this->M_laporan_barang->get_posisi('posisi_barang',$where);
	$this->load->view('back_end/table_content_laporan',$data);
}


//Conf Url
function get_url(){
	$id = $_POST['id'];
	$url = $_POST['url'];

	$respone  = array(
		'respone' => '200',
		'data' => base_url('laporan_barang/'.$url.'/'.$id)
	);

	header('Content-Type: application/json');
	echo json_encode($respone);

	

}



function laporan_jenis() {
	$where = array(
	'state' => 'aktif'	
	);

	$data['jenis']= $this->M_laporan_barang->get_data('jenis',$where);

	// print_r($data);
	$this->load->view('back_end/laporan_jenis',$data);

	// echo "OK";	
}
//Tabel Distributor
function tabel_jenis($id) {
	$where = array(
'barang.id_jenis' => $id,
'barang.state' => 'aktif',
'posisi_barang.state' => 'aktif'
	);

	$data['data'] = $this->M_laporan_barang->get_posisi('posisi_barang',$where);
	$this->load->view('back_end/table_content_laporan',$data);
}




function laporan_perolehan() {
	$where = array(
	'state' => 'aktif'	
	);

	$data['perolehan']= $this->M_laporan_barang->get_data('perolehan',$where);

	// print_r($data);
	$this->load->view('back_end/laporan_perolehan',$data);

	// echo "OK";	
}
//Tabel Distributor
function tabel_perolehan($id) {
	$where = array(
'barang.id_perolehan' => $id,
'barang.state' => 'aktif',
'posisi_barang.state' => 'aktif'
	);

	$data['data'] = $this->M_laporan_barang->get_posisi('posisi_barang',$where);
	$this->load->view('back_end/table_content_laporan',$data);
}



function laporan_pengguna() {
	$where = array(
	'state' => 'aktif'	
	);

	$data['user']= $this->M_laporan_barang->get_data('user',$where);

	// print_r($data);
	$this->load->view('back_end/laporan_pengguna',$data);

	// echo "OK";	
}
//Tabel Distributor
function tabel_user($id) {
	$where = array(
'posisi_barang.id_user_mutasi' => $id,
'barang.state' => 'aktif',
'posisi_barang.state' => 'aktif'
	);

	$data['data'] = $this->M_laporan_barang->get_posisi('posisi_barang',$where);
	$this->load->view('back_end/table_content_laporan',$data);
}



function laporan_ruang() {
	$where = array(
	'state' => 'aktif'	
	);

	$data['ruang']= $this->M_laporan_barang->get_data('ruang',$where);

	// print_r($data);
	$this->load->view('back_end/laporan_ruang',$data);

	// echo "OK";	
}
//Tabel Distributor
function tabel_ruang($id) {
	$where = array(
'posisi_barang.id_ruang_sesudah' => $id,
'barang.state' => 'aktif',
'posisi_barang.state' => 'aktif'
	);

	$data['data'] = $this->M_laporan_barang->get_posisi('posisi_barang',$where);
	$this->load->view('back_end/table_content_laporan',$data);
}



function laporan_status_barang() {
	$where = array(
	'state' => 'aktif'	
	);

	$data['status_barang']= $this->M_laporan_barang->get_data('status_barang',$where);

	// print_r($data);
	$this->load->view('back_end/laporan_status_barang',$data);

	// echo "OK";	
}
//Tabel Distributor
function tabel_status_barang($id) {
	$where = array(
'posisi_barang.id_status_barang' => $id,
'barang.state' => 'aktif',
'posisi_barang.state' => 'aktif'
	);

	$data['data'] = $this->M_laporan_barang->get_posisi('posisi_barang',$where);
	$this->load->view('back_end/table_content_laporan',$data);
}



function laporan_sumber_dana() {
	$where = array(
	'state' => 'aktif'	
	);

	$data['sumber_dana']= $this->M_laporan_barang->get_data('sumber_dana',$where);

	// print_r($data);
	$this->load->view('back_end/laporan_sumber_dana',$data);

	// echo "OK";	
}
//Tabel Distributor
function tabel_sumber_dana($id) {
	$where = array(
'barang.id_sumber_dana' => $id,
'barang.state' => 'aktif',
'posisi_barang.state' => 'aktif'
	);

	$data['data'] = $this->M_laporan_barang->get_posisi('posisi_barang',$where);
	$this->load->view('back_end/table_content_laporan',$data);
}


function tabel_realtime() {
	$where = array(
		'barang.state' => 'aktif',
'posisi_barang.state' => 'aktif'
	);

	$data['data'] = $this->M_laporan_barang->get_posisi('posisi_barang',$where);
	$this->load->view('back_end/table_content_laporan',$data);
}





}