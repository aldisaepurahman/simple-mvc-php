<?php

/********************
 * Filename     : DBBuilder.php
 * Programmer   : Aldi Saepurahman
 * Date         : 2021-04-09
 * Email        : aldisaepurahman@gmail.com
 * Description  : all database processing
*********************/

class DBBuilder{
    //set the host, username, password, and database name from config define
    private $db_host = host;

    private $db_user = username;

    private $db_pass = password;

    private $db_name = database;

    private $connect; //database connection attribute

    private $query; //database query attribute

    private $builder; //database query builder attribute

    private $join; //database query join attribute

    private $where; //database query where attribute
    
    private $groupBy; //database query group by attribute

    private $orderBy; //database query order by attribute

    private $conditions = ['<', '>', '<=', '>=', '!=']; //database query where conditions attributes

    public function __construct()
    {
        //set all attribute to null
        $this->dispose();
    }
    //create new connection to database
    public function createConnection()
    {
        $this->connect = mysqli_connect($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
    }
    //close the connection to database
    public function destroyConnection()
    {
        mysqli_close($this->connect);
    }
    //generate table method
    public function table($table)
    {
        $this->table = $table;
        return $this;
    }
    //generate select query method
    public function select($data)
    {
        $this->builder = "SELECT ";
        //if the data is array, implode it
        if (is_array($data)) {
            $this->builder .= implode(",", $data);
        }
        //if the data is string, join it
        else if(is_string($data)){
            $this->builder .= $data;
        }
        //return the select syntax
        return $this;
    }
    //generate join query builder
    public function join($table, $foreign, $arrow = NULL)
    {
        //if join arrow is not null, switch it
        if ($arrow != NULL) {
            switch ($arrow) {
                //if arrow is left, generate to left join
                case "left":
                    $this->join .= " LEFT JOIN ";
                    break;
                //if arrow is right, generate to right join
                case "right":
                    $this->join .= " RIGHT JOIN ";
                    break;
                //if arrow is not left or right, generate to inner join
                default:
                    $this->join .= " JOIN ";
                    break;
            }
        }
        //if arrow is null, generate to inner join
        else $this->join .= " JOIN ";
        //join with the table and its foreign keys
        $this->join .= $table." ON ".$foreign;
        //return the join syntax
        return $this;
    }
    //generate where query builder
    public function where($cond)
    {
        //if the condition is not array, return error
        if (!is_array($cond)) {
            return "Where conditions must be arrays";
        }
        //if the condition is array
        else{
            $this->where = " WHERE ";
            //count the conditions in the parameter
            $countCond = count($cond);
            $count = 0;
            //loop it
            foreach ($cond as $key => $val) {
                $haveOperator = FALSE;
                //if the key of condition parameter have operator, set to true
                foreach ($this->conditions as $value) {
                    if(strpos($key, $value) !== false){
                        $haveOperator = TRUE;
                        break;
                    }
                }
                //if the condition have operator, generate without equals symbol
                if($haveOperator) $this->where .= $key." '".$val."'";
                //if the condition doesn't have operator, generate with equals symbol
                else $this->where .= $key." = '".$val."'";
                //if the conditions is not final, generate with mysql AND operator
                if($count < $countCond-1) $this->where .= " AND ";
                //count it
                $count++;
            }
            //return the where syntax
            return $this;
        }
    }
    //generate group by query builder
    public function groupBy($cond)
    {
        //set group by query builder and return it
        $this->groupBy = " GROUP BY $cond";
        return $this;
    }
    //generate order by query builder
    public function orderBy($cond, $sort = '')
    {
        //set order by query builder
        $this->orderBy = " ORDER BY $cond";
        //if sort is not null and sort type is descending, join with builder
        if ($sort != NULL && strcasecmp($sort, "DESC") == 0) {
            $this->orderBy .= " $sort";
        }
        //return order by builder
        return $this;
    }
    //generate insert query builder
    public function insert($data)
    {
        //if the data is not array, return error
        if (!is_array($data)) return "Insert data must be arrays";
        //if the data is array
        else{
            //generate keys and value from data, and execute the query
            $this->query = "INSERT INTO $this->table (
                ".implode(",", array_keys($data)).") VALUES ('".implode("','", array_values($data))."')";

            return $this->execute();
        }
    }
    //generate update query builder
    public function update($data, $where)
    {
        //if data or where conditions is not array, return error
        if (!is_array($data) OR !is_array($where)) {
            return "Update data and where clause must be arrays";
        }
        //if both data and where conditions is array
        else{
            //generate where syntax
            $this->where($where);
            //count data request
            $countRows = count($data);
            $count = 0;
            //generate update query
            $this->query = "UPDATE $this->table SET";
            foreach ($data as $key => $value) {
                //generate key and value from data
                $this->query .= " $key = '$value'";
                //if the data request is not final, add comma in the query
                if($count < $countRows-1) $this->query .= ",";
                $count++;
            }
            //join with where syntax and execute it
            $this->query .= $this->where;
            return $this->execute();
        }
    }
    //generate delete query
    public function delete($where)
    {
        //if where conditions is not array, return error
        if (!is_array($where)) {
            return "Where clause must be arrays";
        }
        //if where conditions is array
        else{
            //generate where syntax and join with delete query
            $this->where($where);
            $this->query = "DELETE FROM $this->table";
            $this->query .= $this->where;
            //execute the query
            return $this->execute();
        }
    }
    //generate select query
    public function get()
    {
        //join select builder with from and table name
        $this->query = $this->builder." FROM ". $this->table;
        //if the join syntax is not null, join it
        if ($this->join != NULL) {
            $this->query .= $this->join;
        }
        //if the where conditions is not null, join it
        if($this->where != NULL){
            $this->query .= $this->where;
        }
        //return perfect select query
        return $this;
    }
    //generate all data from select query
    public function getResult()
    {
        //execute select query
        $exec = $this->execute();
        $data = [];
        //insert to array of data
        while($row = mysqli_fetch_assoc($exec)){
            $temp = [];
            //set the data with the key from database
            while ($col = current($row)) {
                $temp[key($row)] = $row[key($row)];
                next($row);
            }
            array_push($data, $temp);
        }
        //return the data
        return $data;
    }
    //generate all data to the object form
    public function convertToObject($array) {
        //call the stdclass
        $object = new \stdClass();
        //convert the data to object
        foreach ($array as $key => $value) {
            //if the value from data is array, proceed it to recursive
            if (is_array($value)) {
                $value = $this->convertToObject($value);
            }
            //set the value
            $object->$key = $value;
        }
        //return the object
        return $object;
    }
    //generate data become array
    public function asArray()
    {
        return $this->getResult();
    }
    //generate data become object
    public function asObject()
    {
        return $this->convertToObject($this->getResult());
    }
    //execute the query method
    public function execute()
    {
        //execute the query and destroy the connection and dispose all query
        $status = mysqli_query($this->connect, $this->query);
        $this->destroyConnection();
        $this->dispose();
        //return the execute status
        return $status;
    }
    //set null all attribute
    public function dispose()
    {
        $this->query = NULL;
        $this->builder = NULL;
        $this->join = NULL;
        $this->where = NULL;
        $this->groupBy = NULL;
        $this->orderBy = NULL;
    }
}

?>
