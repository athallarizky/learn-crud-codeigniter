<?php
 // write your name and student id here
class Mahasiswa extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		//load model "Mahasiswa_model"
		$this->load->model('Mahasiswa_model');
		//load library form validation
		$this->load->library('form_validation');
	}


	public function index()
	{

		$data['judul'] = 'Daftar Mahasiswa';
		$data['mahasiswa'] = $this->Mahasiswa_model->getAllMahasiswa();
		if ($this->input->post('keyword')) {
			$data['mahasiswa'] = $this->Mahasiswa_model->cariDataMahasiswa();
		}
		$this->load->view('templates/header', $data);
		$this->load->view('mahasiswa/index', $data);
		$this->load->view('templates/footer');
	}

	public function tambah()
	{
		$data['judul'] = 'Form Tambah Data Mahasiswa';

		//from library form_validation, set rules for nama, nim, email = required
		$this->form_validation->set_rules('nama', 'Form Nama', 'required');
		$this->form_validation->set_rules('nim', 'Form NIM', 'required');
		$this->form_validation->set_rules('email', 'Form Email', 'required');

		//conditon in form_validation, if user input form = false, then load page "tambah" again
		// else, when successed call method "tambahDataMahasiswa" in Mahasiswa_model
		// use flashdata to to show alert "added success" then back to controller mahasiswa 
		if($this->form_validation->run() === FALSE){
			$this->load->view('templates/header');
			$this->load->view('mahasiswa/tambah');
			$this->load->view('templates/footer');
		}else{
			$this->Mahasiswa_model->tambahDataMahasiswa();
			$this->session->set_flashdata('flash','Data mahasiswa Berhasil ditambahkan');
			redirect('Mahasiswa/');
		}
		
	}

	public function hapus($id)
	{
		//call method hapusDataMahasiswa with parameter id from mahasiswa_model
		$this->Mahasiswa_model->hapusDataMahasiswa($id);
		//use flashdata to show alert "dihapus"
		$this->session->set_flashdata('flash','Data mahasiswa Berhasil dihapus');
		//back to controller mahasiswa
		redirect('Mahasiswa/');

	}

	public function ubah($id)
	{
		$data['judul'] = 'Form Ubah Data Mahasiswa';

		$data['mahasiswa'] = $this->Mahasiswa_model->getMahasiswaById($id);
		$data['jurusan'] = ['Teknik Informatika', 'Teknik Industri', 'Teknik Elektro', 'DKV', 'MBTI'];

		//from library form_validation, set rules for nama, nim, email = required
		$this->form_validation->set_rules('nama', 'Form Nama', 'required');
		$this->form_validation->set_rules('nim', 'Form NIM', 'required');
		$this->form_validation->set_rules('email', 'Form Email', 'required');


		//conditon in form_validation, if user input form = false, then load page "ubah" again
		//else, when successed call method "ubahDataMahasiswa" in Mahasiswa_model
		//use flashdata to to show alert "data changed successfully" then back to controller mahasiswa
		if($this->form_validation->run() === FALSE){
			$this->load->view('templates/header');
			$this->load->view('mahasiswa/ubah', $data);
			$this->load->view('templates/footer');
		}else{
			$this->Mahasiswa_model->ubahDataMahasiswa();
			$this->session->set_flashdata('flash','Data mahasiswa Berhasil diupdate');
			redirect('Mahasiswa/');
		}
		
	}
}
