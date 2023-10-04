<?php

class Project extends Controller {
    // public function index()
    // {
    //     $data = [
    //         "judul" => "Project | Index",
    //         "project" => $this->model('Project_model')->getAllProject(),
            // "pimpro_id" => $this->model("Project_model")->pluck("id_user"),
    //         "layanan" => $this->model('Layanan_model')->getLayanan(),
    //         "customer" => $this->model('Customer_model')->getCustomer(),
    //         "user" => $this->model('User_model')->getUser(),
    //     ]; 

    //     $this->view('templates/header', $data);
    //     $this->view('project/index', $data);
    //     $this->view('templates/footer', $data);
    // }

    public function index($page = 1)
{
    $data['judul'] = 'Project | Index';
    $projectModel = $this->model('Project_model');
    $userModel = $this->model('User_model');
    
    // Menghitung total data dalam model Project_model
    $totalItems = count($projectModel->getAllProject());
    
    // Konfigurasi paginate
    $itemsPerPage = 5;
    
    // Menghitung total halaman dengan menggunakan ceil()
    $totalPages = ceil($totalItems / $itemsPerPage);
    
    // Menghitung offset berdasarkan halaman aktif
    $offset = ($page - 1) * $itemsPerPage;
    
    // Mengambil data yang sesuai dengan halaman aktif dari model
    $pagedData = array_slice($projectModel->getAllProject(), $offset, $itemsPerPage);

    $data['project'] = $pagedData;
    $data['totalPages'] = $totalPages;

    // Mendapatkan data lain dari model-model lain sesuai kebutuhan
    $data['layanan'] = $this->model('Layanan_model')->getLayanan();
    $data['customer'] = $this->model('Customer_model')->getCustomer();
    $data['user'] = $userModel->getPimpro();

    // Mendapatkan semua id_user dari model Project_model
    $pimpro_id = $projectModel->pluck("id_user");
    $data['pimpro_id'] = $pimpro_id;
    // $data['pimpro_id'] = $projectModel->pluck("id_user");

    
    $this->view('templates/header', $data);
    $this->view('project/index', $data);
    $this->view('templates/footer', $data);
}


    public function viewProject($kode_project) {
        $projectData = $this->model('Project_model')->getProjectByKode($kode_project);
        
        $this->view('project/detail', ['projectData' => $projectData]);
    }

    // public function detail($kode_project,)
    // {   
    //     $data['kode_project'] = $kode_project;
    //     $data['project'] = $this->model('Project_model')->getProjectByKode($kode_project);

    //     // var_dump($data['project']);
    //     // return ;
    //     $data['judul'] = 'Detail | Todolist';
    //     $data['todolist'] = $this->model('Todolist_model')->getTodolistByProject($kode_project);
    //     $data['tims'] = $this->model('Tim_model')->getByProjectTim($kode_project);

    //     $this->view('templates/header', $data);
    //     $this->view('project/detail', $data);
    //     $this->view('templates/footer', $data);
    // }

    public function detail($kode_project, $page = 1)
    {
        $data['kode_project'] = $kode_project;
        $projectModel = $this->model('Project_model');

        // Mendapatkan data proyek berdasarkan kode proyek
        $data['project'] = $projectModel->getProjectByKode($kode_project);

        // Memeriksa apakah proyek ditemukan
        if (!$data['project']) {
            // Handle jika proyek tidak ditemukan, misalnya tampilkan pesan kesalahan
            $this->view('templates/header', $data);
            $this->view('error/project_not_found', $data);
            $this->view('templates/footer', $data);
            return;
        }

        $data['judul'] = 'Detail | Todolist';
        $todolistModel = $this->model('Todolist_model');

        // Mendapatkan daftar todolist untuk proyek tertentu
        $allTodolist = $todolistModel->getTodolistByProject($kode_project);

        // Konfigurasi paginate
        $itemsPerPage = 1;
        
        // Menghitung total halaman dengan menggunakan ceil()
        $totalPages = ceil(count($allTodolist) / $itemsPerPage);

        // Menghitung offset berdasarkan halaman aktif
        $offset = ($page - 1) * $itemsPerPage;

        // Mengambil data todolist yang sesuai dengan halaman aktif
        $pagedData = array_slice($allTodolist, $offset, $itemsPerPage);

        $data['todolist'] = $pagedData;
        $data['totalPages'] = $totalPages;

        $timModel = $this->model('Tim_model');

        // Mendapatkan daftar tim yang terlibat dalam proyek tertentu
        $data['tims'] = $timModel->getByProjectTim($kode_project);

        $this->view('templates/header', $data);
        $this->view('project/detail', $data);
        $this->view('templates/footer', $data);
    }

    

    // ini untuk project  

    public function tambah()
    {
        $data = [
            "kode_customer" => $_POST['kode_customer'],
            "kode_layanan" => $_POST['kode_layanan'],
            "nama_project" => $_POST['nama_project'],
            "tanggal_awal" => $_POST['tanggal_awal'],
            "tanggal_akhir" => $_POST['tanggal_akhir'],
            "id_user" => $_POST['id_user'],
        ];

        // if ($this->model("Project_model")->countProjectsByUserId($data['id_user']) >= 5) {
        //     // Jika user sudah memiliki 5 proyek, Anda dapat mednampilkan pesan kesalahan atau melakukan tindakan yang sesuai.
        //     header('Location: ' . BASEURL . '/project');
        //     exit;
        // }

        $this->model("Project_model")->create($data);

        Flasher::setFlash("msg_success", "Berhasil menambahkan project");
        header('Location: ' . BASEURL . '/project');
        exit;
    }

    public function hapus($kode_project)
    {
        if( $this->model('Project_model')->hapusDataProject($kode_project) > 0 ) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/project');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . '/project');
            exit;
        }
    }

    public function getubah()
    {
        // echo $_POST['kode_project'];
        echo json_encode($this->model('Project_model')->getProjectByKode($_POST['kode_project']));
    }

    public function ubah()
    {
        $data = [
            "kode_project" => $_POST['id_project'],
            "kode_customer" => $_POST['kode_customer'],
            "kode_layanan" => $_POST['kode_layanan'],
            "tanggal_awal" => $_POST['tanggal_awal'],
            "tanggal_akhir" => $_POST['tanggal_akhir'],
            "id_user" => $_POST['id_user'],
        ];

        $this->model("Project_model")->update($data);

        Flasher::setFlash("msg_success", "Berhasil mengubah project");
        header("Location:". BASEURL ."/project");
        exit;
    }
}