<?php

class Tim_model
{
    private $table = 'tim_project';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllTim()
    {
        // $id_pemimpin = 1
        $this->db->query( "SELECT tp.*, u.nama AS nama_user, u_pemimpin.nama AS nama_pemimpin, p.nama_project
        FROM tim_project tp
        INNER JOIN users u ON tp.kode_user = u.id
        INNER JOIN project p ON tp.kode_project = p.kode_project
        LEFT JOIN users u_pemimpin ON p.id_user = u_pemimpin.id
    ");
        return $this->db->resultSet();
    }

    public function getAssignedUsers($kode_project) {
        $this->db->query("SELECT kode_user FROM $this->table WHERE kode_project = :kode_project");
        $this->db->bind('kode_project', $kode_project);
        return $this->db->resultSet();
    }
    

    public function pluck($field)
    {
        $this->db->query("SELECT $field FROM $this->table");
        $results = $this->db->resultSet();
        $datas = [];
        foreach ($results as $result) {
            $datas[] = $result[$field];
        }

        return $datas;
    }

    public function getByProjectTim ($kode_project)
    {
        $this->db->query("SELECT tp.*, tu.nama as nama_user, tu.id as id_user from $this->table tp 
        INNER JOIN users tu ON tp.kode_user = tu.id
        where tp.kode_project = :kode_project
        ");
        $this->db->bind("kode_project", $kode_project);
        $this->db->execute();

        return $this->db->resultSet();
    }

    public function getTimByKode($kode_tim)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE kode_tim=:kode_tim');
        $this->db->bind('kode_tim', $kode_tim);
        return $this->db->single();
    }

    public function create($datas)
    {
        $this->db->query("INSERT INTO $this->table (kode_project, nama_job_desk_user, kode_user ) VALUES (:kode_project, :nama_job_desk_user, :kode_user) ");
        foreach ($datas as $key => $data) {
            $this->db->bind($key, $data);
        }
        $this->db->execute();
    }

    public function update($datas)
    {
        $this->db->query("UPDATE $this->table SET kode_project = :kode_project, nama_job_desk_user = :nama_job_desk_user, kode_user = :kode_user WHERE kode_tim = :kode_tim");
        foreach ($datas as $key => $data) {
            $this->db->bind($key, $data);
        }

        $this->db->execute();
    }

    public function hapusDataTim($kode_tim)
    {
        $query = "DELETE FROM tim_project WHERE kode_tim = :kode_tim";

        $this->db->query($query);
        $this->db->bind('kode_tim', $kode_tim);

        $this->db->execute();

        return $this->db->rowCount();
    }


    // public function ubahDataProject($data)
    // {
    //     $query = "UPDATE project SET
    //                 nama = :nama,
    //               WHERE kode_project = :kode_project";

    //     $this->db->query($query);
    //     $this->db->bind('nama', $data['nama']);
    //     $this->db->bind('kode_project', $data['kode_project']);

    //     $this->db->execute();

    //     return $this->db->rowCount();
    // }
}
