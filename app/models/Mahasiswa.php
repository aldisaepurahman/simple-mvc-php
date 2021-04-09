<?php

/********************
 * Filename     : Mahasiswa.php
 * Programmer   : Aldi Saepurahman
 * Date         : 2021-04-09
 * Email        : aldisaepurahman@gmail.com
 * Description  : create mahasiswa model as model child
*********************/

class Mahasiswa extends Model
{
    protected $requiredFields = [];

    protected $primaryKey = 'nim';

    protected $table = 'mahasiswa';

    //the constructor must be declared because db variable is protected by model parent class
    public function __construct()
    {
        parent::__construct();
    }

    public function getMahasiswa()
    {
        return $this->db->table($this->table)->select("*")
        ->where(['angkatan' => '2019'])->get()->asObject();
    }
}


?>