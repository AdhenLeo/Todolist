<?php 

class Project_model {
    private $table = 'project';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllProject()
    {
        $this->db->query("SELECT p.*, u.nama, c.nama_perusahaan, l.nama_layanan
        FROM project p
        INNER JOIN users u ON p.id_user = u.id
        INNER JOIN customer c ON p.kode_customer = c.kode_customer
        INNER JOIN layanan l ON p.kode_layanan = l.kode_layanan;");
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
    
    public function getProjectByKode($kode_project)
    {
        $this->db->query("SELECT p.*, u.nama as nama_user, u.id as id_user FROM $this->table p 
        INNER JOIN users u ON u.id = p.id_user
        WHERE p.kode_project = :kode_project");
        $this->db->bind('kode_project', $kode_project);
        return $this->db->single();
    }
    

    public function create($datas)
    {
        $this->db->query("INSERT INTO $this->table (kode_customer, kode_layanan, nama_project, tanggal_awal, tanggal_akhir, id_user) VALUES (:kode_customer, :kode_layanan, :nama_project, :tanggal_awal, :tanggal_akhir, :id_user) ");
        foreach ($datas as $key => $data) {
            $this->db->bind($key, $data);
        }
        $this->db->execute();
    }

    public function update ($datas) 
    {
        $this->db->query("UPDATE $this->table SET kode_customer = :kode_customer, kode_layanan = :kode_layanan, tanggal_awal = :tanggal_awal, tanggal_akhir = :tanggal_akhir, id_user = :id_user WHERE kode_project = :kode_project");
        foreach ($datas as $key => $data) {
            $this->db->bind($key, $data);
        }

        $this->db->execute();
    }

    public function hapusDataProject($kode_project)
    {
        $query = "DELETE FROM project WHERE kode_project = :kode_project";
        
        $this->db->query($query);
        $this->db->bind('kode_project', $kode_project);

        $this->db->execute();

        return $this->db->rowCount();
    }


    public function countProjectsByUserId($id_user)
    {
        $query = "SELECT COUNT(*) as total_projects FROM $this->table WHERE id_user = :id_user";
        $this->db->query($query);
        $this->db->bind('id_user', $id_user);
        $result = $this->db->single();

        return $result;
    }


}