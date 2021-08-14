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

    public function getMahasiswa($nim = false)
    {
        if ($nim) {
            return $this->db->table($this->table)->select("*")
            ->where(['nim' => $nim])->get()->asObject();
        }
        else{
            return $this->db->table($this->table)->select("*")->get()->asObject();
        }
        /** bisa juga cara aksesnya seperti berikut */
        // $this->db->table($this->table);
        // $this->db->select("*");
        // $this->db->where(['angkatan' => '2019']);
        // $this->db->get();

        // return $this->db->asObject();
    }

    public function insert($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function update($data, $nim)
    {
        return $this->db->table($this->table)->update($data, ['nim' => $nim]);
    }

    public function delete($nim)
    {
        return $this->db->table($this->table)->delete(['nim' => $nim]);
    }
}


?>