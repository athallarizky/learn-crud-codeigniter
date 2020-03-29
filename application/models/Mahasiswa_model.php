<?php
 // write your name and student id here
class Mahasiswa_model extends CI_model
{

	public function __construct()
	{
		$this->load->database();
	}

	public function getAllMahasiswa()
	{
		//use query builder to get data table "mahasiswa"
		return $this->db->get('mahasiswa')->result_array();
		// $query = $this->db->get('tb_datadiri');
        //     return $query->row();

	}

	public function tambahDataMahasiswa()
	{
		$data = [
			"nama" => $this->input->post('nama', true),
			"nim" => $this->input->post('nim', true),
			"email" => $this->input->post('email', true),
			"jurusan" => $this->input->post('jurusan', true),
		];

		//use query builder to insert $data to table "mahasiswa"
		return $this->db->insert('mahasiswa', $data);
	}

	public function hapusDataMahasiswa($id)
	{
		//use query builder to delete data based on id 
		return $this->db->delete('mahasiswa', ['id'=>$id]);
	}

	public function getMahasiswaById($id)
	{
		//get data mahasiswa based on id 
		return $this->db->get_where('mahasiswa', ['id' => $id])->row_array();

	}

	public function ubahDataMahasiswa()
	{
		$data = [
			"nama" => $this->input->post('nama', true),
			"nim" => $this->input->post('nim', true),
			"email" => $this->input->post('email', true),
			"jurusan" => $this->input->post('jurusan', true),
		];
		//use query builder class to update data mahasiswa based on id
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('mahasiswa', $data);
	}

	public function cariDataMahasiswa()
	{
		$keyword = $this->input->post('keyword', true);
		//use query builder class to search data mahasiswa based on keyword "nama" or "jurusan" or "nim" or "email"
		$this->db->like('nama', $keyword);
		//return data mahasiswa that has been searched
		return $this->db->get('mahasiswa')->result_array();
	}
}
