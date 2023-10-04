<?php

class Customer extends Controller {
    // public function index()
    // {
    //     $data = [
    //         "judul" => "Customer | Index",
    //         "usaha" => $this->model('Usaha_model')->getAllUsaha(),
    //         "customer" => $this->model('Customer_model')->getCustomer(),
    //     ]; 
        
    //     $this->view('templates/header', $data);
    //     $this->view('customer/index', $data);
    //     $this->view('templates/footer', $data);
    // }

    public function index($page = 1)
    {
        $data['judul'] = 'Customer | Index';
        $usahaModel = $this->model('Usaha_model');
        $customerModel = $this->model('Customer_model');
        
        // Menghitung total data dalam model Customer_model
        $totalItems = count($customerModel->getCustomer());
        
        // Konfigurasi paginate
        $itemsPerPage = 5;
        
        // Menghitung total halaman dengan menggunakan ceil()
        $totalPages = ceil($totalItems / $itemsPerPage);
        
        // Menghitung offset berdasarkan halaman aktif
        $offset = ($page - 1) * $itemsPerPage;
        
        // Mengambil data yang sesuai dengan halaman aktif dari model
        $pagedData = array_slice($customerModel->getCustomer(), $offset, $itemsPerPage);

        $data['customer'] = $pagedData;
        $data['totalPages'] = $totalPages;
        $data['usaha'] = $usahaModel->getAllUsaha();

        
        $this->view('templates/header', $data);
        $this->view('customer/index', $data);
        $this->view('templates/footer', $data);
    }

    public function detail($kode_customer)
    {
        // var_dump("testq");
        $data['judul'] = 'Detail | Customer';
        $data['project'] = $this->model('Customer_model')->getCustomerByKode($kode_customer);
        $this->view('templates/header', $data);
        $this->view('customer/detail', $data);
        $this->view('templates/footer', $data);
    }

    public function tambah()
    {
        $datas = [
            "nama_perusahaan" => $_POST['nama_perusahaan'],
            "alamat" => $_POST['alamat'],
            "cp" => $_POST['cp'],
            "phone" => $_POST['phone'],
            "email" => $_POST['email'],
            "kode_jenis_usaha" => $_POST['kode_jenis_usaha'],
        ];

        $this->model("Customer_model")->create($datas);

        Flasher::setFlash("msg_success", "Berhasil menambahkan project");
        header('Location: ' . BASEURL . '/customer');
        exit;
    }

    public function hapus($kode_customer)
    {
        if( $this->model('Customer_model')->hapusDataCustomer($kode_customer) > 0 ) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/customer');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . '/customer');
            exit;
        }
    }

    public function getubah()
    {
        // echo $_POST['kode_customer'];
        echo json_encode($this->model('Customer_model')->getCustomerByKode($_POST['kode_customer']));
    }

    public function ubah()
    {
        $data = [
            "kode_customer" => $_POST['kode_customer'],
            "nama_perusahaan" => $_POST['nama_perusahaan'],
            "alamat" => $_POST['alamat'],
            "cp" => $_POST['cp'],
            "phone" => $_POST['phone'],
            "email" => $_POST['email'],
            "kode_jenis_usaha" => $_POST['kode_jenis_usaha'],
        ];

        $this->model("Customer_model")->update($data);

        Flasher::setFlash("msg_success", "Berhasil mengubah project");
        header("Location:". BASEURL ."/customer");
        exit;
    }
}