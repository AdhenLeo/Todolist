<?php

    class Auth extends Controller
    {
        public function login () 
        {
            $data['judul'] = 'Login';

            $this->view('templates/auth/header', $data);
            $this->view('auth/login', $data);
            $this->view('templates/auth/footer', $data);
        }

        public function user () 
        {
            $data['judul'] = 'Users';
            $data['user'] = $this->model('User_model')->getUser();
            $this->view('templates/header', $data);
            $this->view('auth/user', $data);
            $this->view('templates/footer', $data);
        }
        public function reqLogin() {
            $email = $_POST['email'];
            $password = md5($_POST['password']); // Use 'password' to match the 'name' attribute in the form
            $userModel = $this->model('User_model'); // Create an instance of User_model
        
            if (!empty($email) && !empty($password)) {
                // // Debugging output
                // echo "Email: " . $email . "<br>";
                // echo "Password (hashed): " . $password . "<br>";
        
                $user = $userModel->getUserByEmailAndPassword($email, $password);
        
                if ($user) {
                    session_start();
                    $_SESSION['unique_id'] = $user['unique_id'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['password'] = $user['password'];
                    $_SESSION['role'] = $user['role'];
                    echo "success";
                    Flasher::setFlash("msg_success", "Berhasil menambahkan user");
                    header('Location: ' . BASEURL . '/home');
                    exit;
                } else {
                    echo "Email or Password is Incorrect!";
                }
            } else {
                echo "All Fields are Required!";
            }
            
        }

        public function register()
        {
            $data['judul'] = 'Register';

            // Jika ini adalah GET request (tampilan halaman registrasi)
            $this->view('templates/auth/header', $data);
            $this->view('auth/register', $data); // Sesuaikan dengan alamat tampilan Anda
            $this->view('templates/auth/footer', $data);
        }

        public function requestRegister()
        {

            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $password = password_hash($_POST['pass'], PASSWORD_DEFAULT);
            $cpassword = password_hash($_POST['cpass'], PASSWORD_DEFAULT);

            $verification_status = '0';
            $role = 'user'; // Set role sebagai "user"

            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // Checking if email already exists
                $userModel = $this->model('User_model');
                $emailExists = $userModel->isEmailExists($email);

                if ($emailExists) {
                    echo "$email - Already Exists!";
                } else {
                    if ($_POST['pass'] == $_POST['cpass']) {
                        // Continue with the database insertion
                        $random_id = rand(time(), 10000000);
                        $otp = mt_rand(1111, 9999);

                        $data = [
                            'unique_id' => $random_id,
                            'fname' => $fname,
                            'lname' => $lname,
                            'email' => $email,
                            'password' => $password,
                            'image' => "profile/kosong.jpg",
                            'otp' => $otp,
                            'verification_status' => $verification_status,
                            'role' => $role,
                        ];

                        if ($_FILES['image']['tmp_name'] !== "") {
                            echo "ok";
                            $path = $this->put("profile", $_FILES['image']);
                            $data['image'] = $path;
                        }

                        $data = $userModel->create($data);

                        Flasher::setFlash("msg_success", "Berhasil menambahkan user");
                        header('Location: ' . BASEURL . '/home');
                        exit;

                        // if ($user) {
                        //     $user = $userModel->getUserByEmail($email);
                
                        //     // Send email
                        //     $receiver = $email;
                        //     $subject = "From: $fname $lname <$email>";
                        //     $body = "Name " . " $fname $lname  \n Email" . " $email \n Otp" . " $otp ini kode verifikasi anda" ;
                        //     $headers = "From: varelstevenmaylano17@gmail.com";

                        //     $mail = mail($receiver, $subject, $body, $headers);
                        //     var_dump($mail);
                        //     if ($mail) {
                        //         // Pengiriman email berhasil, arahkan pengguna ke halaman verifikasi
                    
                        //         exit(); // Penting untuk memastikan pengalihan berhasil
                        //     } else {
                        //         echo "Email Problem!";
                        //     }
                        // } else {
                        //     echo "Something went wrong!";
                        // }
                    } else {
                        echo "Confirm Password Don't Match!";
                    }
                }
            } else {
                echo "$email ~ This is not a valid Email!";
            }
        }

        public function getubah()
        {
            // echo $_POST['kode_layanan'];
            echo json_encode($this->model('User_model')->getUserByKode($_POST['id']));
        }

        public function ubah()
    {
        $datas = [
            "fname" => $_POST['fname'],
            "lname" => $_POST['lname'],
            "email" => $_POST['email'],
            "role" => $_POST['role'],
        ];

        if ($_FILES['image']['tmp_name'] !== "") {
            echo "ok";
            $path = $this->put("profile", $_FILES['image']);
            $data['image'] = $path;
        }

        $this->model("User_model")->update($datas);

        Flasher::setFlash("msg_success", "Berhasil mengubah user");
        header("Location:". BASEURL ."/auth/user");
        exit;
    }
    }
    

    ?>