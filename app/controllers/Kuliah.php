<?php

/********************
 * Filename     : Perkuliahan.php
 * Programmer   : Aldi Saepurahman
 * Date         : 2021-04-09
 * Email        : aldisaepurahman@gmail.com
 * Description  : create perkuliahan controller as controller child
*********************/

class Kuliah extends Controller
{
    private $mahasiswa;

    public function __construct() {
        $this->mahasiswa = $this->model('Mahasiswa');
    }

    public function index()
    {
        $data = [
            'title' => 'Data Mahasiswa',
            'mhs' => $this->mahasiswa->getMahasiswa()
        ];

        $this->view('templates/header', $data);
        $this->view('landing_page', $data);
        $this->view('templates/footer', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form Mahasiswa'
        ];

        $this->view('templates/header', $data);
        $this->view('form_tambah', $data);
        $this->view('templates/footer', $data);
    }

    public function edit($nim)
    {
        $isi = $this->mahasiswa->getMahasiswa($nim);

        $data = [
            'title' => 'Form Mahasiswa',
            'mhs' => $isi
        ];

        $this->view('templates/header', $data);
        $this->view('form_edit', $data);
        $this->view('templates/footer', $data);
    }

    public function insert()
    {
        $data = [
            'nim' => $_POST['nim'],
            'nama' => $_POST['nama'],
            'telp' => $_POST['telp'],
            'angkatan' => $_POST['angkatan']
        ];

        if ($this->mahasiswa->insert($data)) {
            $this->redirectTo('kuliah');
        }
        else{
            $this->redirectTo('kuliah/create');
        }
    }

    public function update($nim)
    {
        $data = [
            'nim' => $_POST['nim'],
            'nama' => $_POST['nama'],
            'telp' => $_POST['telp'],
            'angkatan' => $_POST['angkatan']
        ];

        if ($this->mahasiswa->update($data, $nim)) {
            $this->redirectTo('kuliah');
        }
        else{
            $this->redirectTo('kuliah/edit/'.$nim);
        }
    }

    public function delete($nim)
    {
        if ($this->mahasiswa->delete($nim)) {
            $this->redirectTo('kuliah');
        }
        else{
            $this->redirectTo('kuliah');
        }
    }
}


?>