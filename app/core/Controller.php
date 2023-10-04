<?php 

class Controller {
    public function view($view, $data = [])
    {
        require_once '../app/views/' . $view . '.php';
    }

    public function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model;
    }
    
    public function put ($directory, $files) 
    {
        if(!file_exists("img/".$directory."/")) {
            mkdir("img/".$directory."/", 0755, true);
        }

        $filepath = $directory."/" . base64_encode($files['tmp_name']). "." . pathinfo($files['name'])['extension'];

        move_uploaded_file($files["tmp_name"], "img/".$filepath);

        return $filepath;
    }
}