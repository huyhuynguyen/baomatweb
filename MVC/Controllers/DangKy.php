<?php
    class DangKy extends Controller {
        function __construct() {
            if (isset($_SESSION["username"])) {
                unset($_SESSION["username"]);
                unset($_SESSION["fullname"]);
            }
                
            $this->view("layout2", [
                "Page" => "dangky"
            ]);
        }

        function XuLyDangKy() {
            if (isset($_POST["signup"])) {
                $username=$_POST["username"];
                $password=$_POST["password"];
                $fullname=$_POST["fullname"];

                if ($this->model("TaikhoanModel")->checkSignUp($username)==0) {
                    $this->model("TaikhoanModel")->insertUser($username, $password, $fullname);
                    $_SESSION["fullname"]=$fullname;
                    $_SESSION["username"]=$username;
                    header("Location: http://localhost/BMW/Home");
                }
                else {
                    $_SESSION["err_signup"]="Tài khoản đã tồn tại, xin vui lòng thử lại";
                    header("Location: http://localhost/BMW/DangKy");
                }
            }
        }
    }
?>