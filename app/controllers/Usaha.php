<?php

class Usaha extends Controller {
    // public function index()
    // {
    //     // var_dump("teste");
    //     $data['judul'] = 'Usaha | Index';
    //     $data['usaha'] = $this->model('Usaha_model')->getAllUsaha();
    //     $this->view('templates/header', $data);
    //     $this->view('usaha/index', $data);
    //     $this->view('templates/footer', $data);
    // }

    public function index($page = 1)
    {
        $data['judul'] = 'Usaha | Index';
        $usahaModel = $this->model('Usaha_model');
        
        // Menghitung total data dalam model Usaha_model
        $totalItems = count($usahaModel->getAllUsaha());
        
        // Konfigurasi paginate
        $itemsPerPage = 5;
        
        // Menghitung total halaman dengan menggunakan ceil()
        $totalPages = ceil($totalItems / $itemsPerPage);
        
        // Menghitung offset berdasarkan halaman aktif
        $offset = ($page - 1) * $itemsPerPage;
        
        // Mengambil data yang sesuai dengan halaman aktif dari model
        $pagedData = array_slice($usahaModel->getAllUsaha(), $offset, $itemsPerPage);

        $data['usaha'] = $pagedData;
        $data['totalPages'] = $totalPages;
        
        $this->view('templates/header', $data);
        $this->view('usaha/index', $data);
        $this->view('templates/footer', $data);
    }

    public function detail($kode_jenis_usaha)
    {
        // var_dump("testq");
        $data['judul'] = 'Detail | Usaha';
        $data['usaha'] = $this->model('Usaha_model')->getUsahaByKode($kode_jenis_usaha);
        $this->view('templates/header', $data);
        $this->view('usaha/detail', $data);
        $this->view('templates/footer', $data);
    }

    public function tambah()
    {
        $data = [
            "nama" => $_POST["nama"],
        ];

        $this->model("Usaha_model")->create($data);

        Flasher::setFlash("msg_success", "Berhasil menambahkan layanan");
        header("Location:". BASEURL ."/usaha");
        exit;
    }    

    public function hapus($kode_jenis_usaha)
    {
        if( $this->model('Usaha_model')->hapusDataUsaha($kode_jenis_usaha) > 0 ) {
            Flasher::setFlash('msg_success', "Berhasil menghapus layanan");
            header('Location: ' . BASEURL . '/usaha');
            exit;
        } else {
            Flasher::setFlash('msg_error', "Berhasil menghapus layanan");
            header('Location: ' . BASEURL . '/usaha');
            exit;
        }
    }

    public function getubah()
    {
        // echo $_POST['kode_jenis_usaha'];
        echo json_encode($this->model('Usaha_model')->getUsahaByKode($_POST['kode_jenis_usaha']));
    }

    public function ubah()
    {
        $datas = [
            "kode_jenis_usaha" => $_POST['kode_jenis_usaha'],
            "nama" => $_POST['nama'],
        ];

        $this->model("Usaha_model")->update($datas);

        Flasher::setFlash("msg_success", "Berhasil mengubah layanan");
        header("Location:". BASEURL ."/usaha");
        exit;
    }
}