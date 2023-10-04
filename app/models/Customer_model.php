<?php 

class Customer_model {
    private $table = 'customer';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getCustomer()
    {
        $this->db->query("SELECT c.*, j.nama AS nama FROM customer c
        LEFT JOIN jenis_usaha j ON c.kode_jenis_usaha = j.kode_jenis_usaha");
        return $this->db->resultSet();
    }

    public function getCustomerByKode($kode_customer)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE kode_customer=:kode_customer');
        $this->db->bind('kode_customer', $kode_customer);
        return $this->db->single();
    }

    public function create($datas)
    {
        $this->db->query('INSERT INTO customer (nama_perusahaan, alamat, cp, phone, email, kode_jenis_usaha) VALUES (:nama_perusahaan, :alamat, :cp, :phone, :email, :kode_jenis_usaha)');
        
        foreach ($datas as $key => $data) {
            $this->db->bind($key, $data);
        }
        $this->db->execute();
        
        return $this->db->rowCount();
    }

    public function hapusDataCustomer($kode_customer)
    {
        $query = "DELETE FROM customer WHERE kode_customer = :kode_customer";
        
        $this->db->query($query);
        $this->db->bind('kode_customer', $kode_customer);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function update ($datas) 
    {
        $this->db->query("UPDATE $this->table SET kode_jenis_usaha = :kode_jenis_usaha, nama_perusahaan = :nama_perusahaan, alamat = :alamat, cp = :cp, phone = :phone, email = :email WHERE kode_customer = :kode_customer");
        foreach ($datas as $key => $data) {
            $this->db->bind($key, $data);
        }

        $this->db->execute();
    }

}