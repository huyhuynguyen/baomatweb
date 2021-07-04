<?php
    class DangNhap extends Controller {
        function __construct() {
            if (isset($_SESSION["username"])) {
                unset($_SESSION["fullname"]);
                unset($_SESSION["username"]);
            }
            
            $this->view("layout2", [
                "Page" => "dangnhap",
                "titlePage" => "Đăng Nhập"
            ]);
        }

        function XuLyDangNhap() {
            if (isset($_POST["login"])) {
                $username=strip_tags($_POST["username"]);
                $password=strip_tags($_POST["password"]);

                $fullname=$this->model("TaiKhoanModel")->getFullName($username, $password);
                if ($fullname) {
                    $_SESSION["role"]=$this->model("TaiKhoanModel")->getRole($username, $password);
                    $_SESSION["fullname"]=$fullname;
                    $_SESSION["username"]=$username;
                    header("Location: http://localhost/BMW/Home");
                }
                    
                else {
                    $_SESSION["err_login"]="
                        <div class='main__error-container'>
                            <div class='error'>
                                Đăng nhập sai, xin vui lòng thử lại
                            </div>
                        </div>
                    ";
                    header("Location: http://localhost/BMW/DangNhap");
                }
                    
            }
        }
    }
?>