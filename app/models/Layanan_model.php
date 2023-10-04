<?php 

class Layanan_model {
    private $table = 'layanan';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getLayanan()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getLayananByKode($kode_layanan)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE kode_layanan=:kode_layanan');
        $this->db->bind('kode_layanan', $kode_layanan);
        return $this->db->single();
    }

    public function create ($datas) 
    {
        $this->db->query("INSERT INTO layanan (nama_layanan, harga) VALUES (:nama_layanan, :harga)");
        foreach ($datas as $key => $data) {
            $this->db->bind($key, $data);
        }

        $this->db->execute();
    }

    public function update ($datas) 
    {
        $query = "UPDATE layanan SET
        nama_layanan = :nama_layanan,
        harga = :harga
        WHERE kode_layanan = :kode_layanan";

        $this->db->query($query);
        $this->db->bind('nama_layanan', $datas['nama_layanan']);
        $this->db->bind('harga', $datas['harga']);
        $this->db->bind('kode_layanan', $datas['kode_layanan']);

        $this->db->execute();
        return $this->db->rowCount();

    }

    // public function tambahDataLayanan($data)
    // {
    //     $query = "INSERT INTO layanan
    //                 VALUES
    //               ('', :nama_layanan, :harga)";
        
    //     $this->db->query($query);
    //     $this->db->bind('nama_layanan', $data['nama_layanan']);
    //     $this->db->bind('harga', $data['harga']);
    //     $this->db->execute();
        
    //     return $this->db->rowCount();
    // }

    public function hapusDataLayanan($kode_layanan)
    {
        $query = "DELETE FROM layanan WHERE kode_layanan = :kode_layanan";
        
        $this->db->query($query);
        $this->db->bind('kode_layanan', $kode_layanan);

        $this->db->execute();

        return $this->db->rowCount();
    }

    // public function ubahDataLayanan($data)
    // {
        // $query = "UPDATE layanan SET
        //             nama_layanan = :nama_layanan,
        //             harga = :harga
        //           WHERE kode_layanan = :kode_layanan";
        
        // $this->db->query($query);
        // $this->db->bind('nama_layanan', $data['nama_layanan']);
        // $this->db->bind('harga', $data['harga']);
        // $this->db->bind('kode_layanan', $data['kode_layanan']);

    //     $this->db->execute();

    //     return $this->db->rowCount();
    // }

}