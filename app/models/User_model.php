<?php

class User_model{
    private $table = 'users';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    
    public function getUser(){
        $this->db->query("SELECT * FROM $this->table WHERE nama <> 'admin' ORDER BY nama ASC");
        return $this->db->resultSet();
    }
    
}