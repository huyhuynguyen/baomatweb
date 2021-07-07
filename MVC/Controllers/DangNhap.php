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
                $checkBox=$_POST["remember_username"];
                $username=strip_tags($_POST["username"]);
                $password=strip_tags($_POST["password"]);
                $password=hash("sha256", $password);

                $fullname=$this->model("TaiKhoanModel")->getFullName($username, $password);
                if ($fullname) {
                    $_SESSION["role"]=$this->model("TaiKhoanModel")->getRole($username, $password);
                    if ($checkBox=="on")
                        $_SESSION["save_username"]=$username;
                    else 
                        if (isset($_SESSION["save_username"]))
                            unset($_SESSION["save_username"]);
                    $_SESSION["fullname"]=$fullname;
                    $_SESSION["username"]=$username;
                    $_SESSION["last_login_timestamp"]=time();
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