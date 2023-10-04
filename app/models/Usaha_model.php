<?php 

class Usaha_model {
    private $table = 'jenis_usaha';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllUsaha()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getUsahaByKode($kode_jenis_usaha)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE kode_jenis_usaha=:kode_jenis_usaha');
        $this->db->bind('kode_jenis_usaha', $kode_jenis_usaha);
        return $this->db->single();
    }

    public function create ($datas) 
    {
        $this->db->query("INSERT INTO jenis_usaha (nama) VALUES (:nama)");
        foreach ($datas as $key => $data) {
            $this->db->bind($key, $data);
        }

        $this->db->execute();
    }

    public function hapusDataUsaha($kode_jenis_usaha)
    {
        $query = "DELETE FROM jenis_usaha WHERE kode_jenis_usaha = :kode_jenis_usaha";
        
        $this->db->query($query);
        $this->db->bind('kode_jenis_usaha', $kode_jenis_usaha);

        $this->db->execute();

        return $this->db->rowCount();
    }


    public function update ($datas) 
    {
        $query = "UPDATE jenis_usaha SET nama = :nama WHERE kode_jenis_usaha = :kode_jenis_usaha";
        $this->db->query($query);
        $this->db->bind('nama', $datas['nama']);
        $this->db->bind('kode_jenis_usaha', $datas['kode_jenis_usaha']);

        $this->db->execute();
        return $this->db->rowCount();

    }
    // public function ubahDataUsaha($data)
    // {
    //     $query = "UPDATE jenis_usaha SET
    //                 nama = :nama,
    //               WHERE kode_jenis_usaha = :kode_jenis_usaha";
        
    //     $this->db->query($query);
    //     $this->db->bind('nama', $data['nama']);
    //     $this->db->bind('kode_jenis_usaha', $data['kode_jenis_usaha']);

    //     $this->db->execute();

    //     return $this->db->rowCount();
    // }


}