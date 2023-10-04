<?php

class Layanan extends Controller {

    public function __construct()
    {
        if(!isset($_SESSION['user'])){
            header("Location:".BASEURL."/auth/login");
            exit;
        }
    }

    public function index($page = 1)
    {
        if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 'admin') {
        
        // var_dump("teste");
        $data['judul'] = 'Layanan | Index';
        $layananModel = $this->model('Layanan_model');
        
        // Menghitung total data dalam model Layanan_model
        $totalItems = count($layananModel->getLayanan());
        
        // Konfigurasi paginate
        $itemsPerPage = 5;
        
        // Menghitung total halaman dengan menggunakan ceil()
        $totalPages = ceil($totalItems / $itemsPerPage);
        
        // Menghitung offset berdasarkan halaman aktif
        $offset = ($page - 1) * $itemsPerPage;
        
        // Mengambil data yang sesuai dengan halaman aktif dari model
        $pagedData = array_slice($layananModel->getLayanan(), $offset, $itemsPerPage);

        $data['layanan'] = $pagedData;
        $data['totalPages'] = $totalPages;
        
        $this->view('templates/header', $data);
        $this->view('layanan/index', $data);
        $this->view('templates/footer', $data);

        }else {
            header('Location: ' . BASEURL . '/project'); 
        }
        
    }

    public function detail($kode_layanan)
    {
        // var_dump("testq");
        $data['judul'] = 'Detail | Layanan';
        $data['layanan'] = $this->model('Layanan_model')->getLayananByKode($kode_layanan);
        $this->view('templates/header', $data);
        $this->view('layanan/detail', $data);
        $this->view('templates/footer', $data);
    }

    public function tambah()
    {
        $data = [
            "nama_layanan" => $_POST["nama_layanan"],
            "harga" => $_POST["harga"],
        ];

        $this->model("Layanan_model")->create($data);
        Flasher::setFlash("msg_success", "Berhasil menambahkan layanan");

        header("Location:". BASEURL ."/layanan");
        exit;
    }    

    public function hapus($kode_layanan)
    {
        if( $this->model('Layanan_model')->hapusDataLayanan($kode_layanan) > 0 ) {
            Flasher::setFlash('msg_success', "Berhasil menghapus layanan");
            header('Location: ' . BASEURL . '/layanan');
            exit;
        } else {
            Flasher::setFlash('msg_error', "Berhasil menghapus layanan");
            header('Location: ' . BASEURL . '/layanan');
            exit;
        }
    }

    public function getubah()
    {
        // echo $_POST['kode_layanan'];
        echo json_encode($this->model('Layanan_model')->getLayananByKode($_POST['kode_layanan']));
    }

    public function ubah()
    {
        $datas = [
            "kode_layanan" => $_POST['kode_layanan'],
            "nama_layanan" => $_POST['nama_layanan'],
            "harga" => $_POST['harga'],
        ];

        $this->model("Layanan_model")->update($datas);

        Flasher::setFlash("msg_success", "Berhasil mengubah layanan");
        header("Location:". BASEURL ."/layanan");
        exit;
    }
}