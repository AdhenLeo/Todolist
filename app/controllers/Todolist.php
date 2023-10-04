<?php

class Todolist extends Controller {
    public function index($kode_project)
{
    $data['judul'] = 'Todolist | Index';
    $data['todolist'] = $this->model('Todolist_model')->getAllTodolist($kode_project);

    $this->view('templates/header', $data);
    $this->view('todolist/index', $data);
    $this->view('templates/footer', $data);
}

    public function detail($id)
    {
        // var_dump("testq");
        $data['judul'] = 'Detail | Todolist';
        $data['todolist'] = $this->model('Todolist_model')->getTodolistByKode($id);

        $this->view('templates/header', $data);
        $this->view('todolist/detail', $data);
        $this->view('templates/footer', $data);
    }
    

    // public function viewProject($kode_project) {
    //     $projectData = $this->model('Project_model')->getProjectByKodeProject($kode_project);
        
    //     $this->view('todolist/index', ['projectData' => $projectData]);
    // }
    public function tambah($kode_project){
        
        $datas = [
            "kode_project" => $_POST['kode_project'], 
            "tanggal" => $_POST['tanggal'],
            "tugas" => $_POST['tugas'],
            "keterangan" => $_POST['keterangan'],
            "id_user" => $_POST['id_user'],
        ];
    
        $this->model("Todolist_model")->create($datas);
    
        Flasher::setFlash("msg_success", "Berhasil menambahkan project");
        header('Location: ' . BASEURL . '/project/detail/' . $kode_project);
        exit;
    }
    
    public function hapus($id, $kode_project)
    {
        if( $this->model('Todolist_model')->hapusDataTodo($id) > 0 ) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/project/detail/' . $kode_project);
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . '/project/detail/' . $kode_project);
            exit;
        }
    }

    public function getubah()
    {
        // echo $_POST['id'];
        echo json_encode($this->model('Todolist_model')->find($_POST['id']));
    }

    public function ubah($id)
    {

        $datas = [
            "id" => $_POST['id'],
            "kode_project" => $_POST['kode_project'],
            "tugas" => $_POST['tugas'],
            "tanggal" => $_POST['tanggal'],
            "keterangan" => $_POST['keterangan'],
            "id_user" => $_POST['id_user'],
        ];

        $this->model("Todolist_model")->update($datas);

        Flasher::setFlash("msg_success", "Berhasil mengubah project");
        header("Location:". BASEURL . '/project/detail/'. $id);
        exit;
    }

    public function setketerangan()
    {
        try {
            $data = [
                "id" => $_POST['id'],
                "keterangan" => $_POST['keterangan'] == "Proses" ? "Selesai" : "Proses"
            ];
            
            $tes = $this->model("Todolist_model")->updateStatus($data);

            echo "success";
        } catch (\Throwable $th) {
            echo $th;
        }
    }
}