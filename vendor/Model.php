<?php

/********************
 * Filename     : Model.php
 * Programmer   : Aldi Saepurahman
 * Date         : 2021-04-09
 * Email        : aldisaepurahman@gmail.com
 * Description  : create model parent
*********************/

class Model{

    protected $db; //connection attribute

    protected $requiredFields = []; //all fields in table attribute

    protected $primaryKey; //primary key attribute

    protected $table; //table attribute

    public function __construct()
    {
        $this->db = new DBBuilder(); //instantiate the database builder
        $this->db->createConnection(); //create new connection
    }
}
?>