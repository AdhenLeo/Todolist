<?php 

class Home extends Controller {
    public function index()
    {
        $data = [
            "judul" => "Home | Index",
            "project" => $this->model('Project_model')->getAllProject(),
            "pimpro_id" => $this->model("Project_model")->pluck("id_user"),
            "layanan" => $this->model('Layanan_model')->getLayanan(),
            "customer" => $this->model('Customer_model')->getCustomer(),
            "user" => $this->model('User_model')->getUser(),
        ];
        
        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer', $data);
    }
}