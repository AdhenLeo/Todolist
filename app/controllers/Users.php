<?php

class Layanan extends Controller {
    public function index()
    {
        // var_dump("teste");
        $data['judul'] = 'Users | Index';
        $data['users'] = $this->model('Users_model')->getUser();
        $this->view('templates/header', $data);
        $this->view('users/index', $data);
        $this->view('templates/footer', $data);
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