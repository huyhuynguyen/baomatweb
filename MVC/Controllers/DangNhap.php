<?php
    class DangNhap extends Controller {
        function __construct() {
            if (isset($_SESSION["username"])) {
                unset($_SESSION["fullname"]);
                unset($_SESSION["username"]);
            }
            
            $this->view("layout2", [
                "Page" => "dangnhap"
            ]);
        }

        function XuLyDangNhap() {
            if (isset($_POST["login"])) {
                $username=$_POST["username"];
                $password=$_POST["password"];

                $fullname=$this->model("TaiKhoanModel")->getFullName($username, $password);
                if ($fullname) {
                    $_SESSION["role"]=$this->model("TaiKhoanModel")->getRole($username, $password);
                    $_SESSION["fullname"]=$fullname;
                    $_SESSION["username"]=$username;
                    header("Location: http://localhost/BMW/Home");
                }
                    
                else {
                    $_SESSION["err_login"]="Đăng nhập sai, xin vui lòng thử lại";
                    header("Location: http://localhost/BMW/DangNhap");
                }
                    
            }
        }
    }
?>