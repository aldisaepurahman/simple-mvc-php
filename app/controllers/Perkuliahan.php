<?php

/********************
 * Filename     : Perkuliahan.php
 * Programmer   : Aldi Saepurahman
 * Date         : 2021-04-09
 * Email        : aldisaepurahman@gmail.com
 * Description  : create perkuliahan controller as controller child
*********************/

class Perkuliahan extends Controller
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

        $this->view('home', $data);
    }
}


?>