<?php 

class Todolist_model {
    private $table = 'to_do_list';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllTodolist($kode_project)
    {
        $this->db->query("SELECT tdl.*, u.nama as nama_user, p.nama_project as np, u.pemimpin as nama_pemimpin FROM to_do_list tdl
        INNER JOIN users u on tdl.kode_tim = u.id
        INNER JOIN project p ON tdl.kode_project = p.kode_project
        LEFT JOIN users pemimpin ON p.id_user = pemimpin.id
        ");
    
        $this->db->bind(':kode_project', $kode_project);
        return $this->db->resultSet();
    }
    

    public function getTodolistByProject($kode_project)
    {
        $this->db->query("SELECT tl.*, tp.nama_project, tu.nama as nama_user FROM to_do_list tl
        INNER JOIN project tp ON tp.kode_project = tl.kode_project
        INNER JOIN users tu ON tu.id = tl.id_user
        WHERE tl.kode_project = :kode_project");
        $this->db->bind('kode_project', $kode_project);
        return $this->db->resultSet();
    }
    
    public function create($datas)
    {
        $this->db->query("INSERT INTO $this->table (kode_project, tugas, tanggal, keterangan, id_user) VALUES (:kode_project, :tugas, :tanggal, :keterangan, :id_user) ");
    
        foreach($datas as $key => $data){
            $this->db->bind($key, $data);
        }
    
        $this->db->execute();
    }

    public function find($id)
    {
        $this->db->query("SELECT * FROM $this->table WHERE id = :id");
        $this->db->bind("id", $id);

        $this->db->execute();
        return $this->db->single();
    }

    

    public function update ($datas) 
    {
        $this->db->query("UPDATE $this->table SET kode_project = :kode_project, keterangan = :keterangan, tanggal = :tanggal, tugas = :tugas, id_user = :id_user WHERE id = :id");
        foreach ($datas as $key => $data) {
            $this->db->bind($key, $data);
        }

        $this->db->execute();
    }

    public function updateStatus ($datas) 
    {
        $this->db->query("UPDATE $this->table SET keterangan = :keterangan WHERE id = :id");
        foreach ($datas as $key => $data) {
            $this->db->bind($key, $data);
        }

        $this->db->execute();


    }

    public function hapusDataTodo($id)
    {
        $query = "DELETE FROM to_do_list WHERE id = :id";
        
        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }


}