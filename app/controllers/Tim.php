<?php

class Tim extends Controller {
    // public function index()
    // {
    //     $data = [
    //         "judul" => "Tim | Index",
    //         "tim" => $this->model('Tim_model')->getAllTim(),
    //         "project" => $this->model('Project_model')->getAllProject(),
    //         "pimpro_id" => $this->model("Project_model")->pluck("id_user"),
    //         "user" => $this->model('User_model')->getUser(),
    //     ]; 

    //     $this->view('templates/header', $data);
    //     $this->view('tim/index', $data);
    //     $this->view('templates/footer', $data);
    // }


    public function index($page = 1)
    {
        $data['judul'] = 'Tim | Index';
        $timModel = $this->model('Tim_model');
        
        // Menghitung total data dalam model Tim_model
        $totalItems = count($timModel->getAllTim());
        
        // Konfigurasi paginate
        $itemsPerPage = 5;
        
        // Menghitung total halaman dengan menggunakan ceil()
        $totalPages = ceil($totalItems / $itemsPerPage);
        
        // Menghitung offset berdasarkan halaman aktif
        $offset = ($page - 1) * $itemsPerPage;
        
        // Mengambil data yang sesuai dengan halaman aktif dari model
        $pagedData = array_slice($timModel->getAllTim(), $offset, $itemsPerPage);

        $data['tim'] = $pagedData;
        $data['totalPages'] = $totalPages;
        
        // Mendapatkan data lain dari model-model lain sesuai kebutuhan
        $data['project'] = $this->model('Project_model')->getAllProject();
        $data['pimpro_id'] = $this->model("Project_model")->pluck("id_user");
        $data['user'] = $this->model('User_model')->getUser();
        
        $this->view('templates/header', $data);
        $this->view('tim/index', $data);
        $this->view('templates/footer', $data);
    }

    public function detail($kode_tim)
    {
        // var_dump("testq");
        $data['judul'] = 'Detail | Todolist';
        $data['tim'] = $this->model('Tim_model')->getTimByKode($kode_tim);
        $this->view('templates/header', $data);
        $this->view('tim/detail', $data);
        $this->view('templates/footer', $data);
    }

    public function tambah()
    {
        $data = [
            "kode_project" => $_POST['kode_project'],
            "nama_job_desk_user" => $_POST['nama_job_desk_user'],
            "kode_user" => $_POST['kode_user'],
        ];

        $this->model("Tim_model")->create($data);

        Flasher::setFlash("msg_success", "Berhasil menambahkan project");
        header('Location: ' . BASEURL . '/tim');
        exit;
    }

    public function hapus($kode_tim)
    {
        if( $this->model('Tim_model')->hapusDataTim($kode_tim) > 0 ) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/tim');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . '/tim');
            exit;
        }
    }

    public function getubah()
    {
        // echo $_POST['kode_tim'];
        echo json_encode($this->model('Tim_model')->getTimByKode($_POST['kode_tim']));
    }

    public function ubah()
    {
        $datas = [
            "kode_tim" => $_POST['kode_tim'],
            "kode_project" => $_POST['kode_project'],
            "nama_job_desk_user" => $_POST['nama_job_desk_user'],
            "kode_user" => $_POST['kode_user'],
        ];

        $this->model("Tim_model")->update($datas);

        Flasher::setFlash("msg_success", "Berhasil mengubah project");
        header("Location:". BASEURL ."/tim");
        exit;
    }
}