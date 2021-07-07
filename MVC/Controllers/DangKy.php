<?php
    class DangKy extends Controller {
        function __construct() {
            if (isset($_SESSION["username"])) {
                unset($_SESSION["username"]);
                unset($_SESSION["fullname"]);
            }
                
            $this->view("layout2", [
                "Page" => "dangky",
                "titlePage" => "Đăng Ký"
            ]);
        }

        function XuLyDangKy() {
            if (isset($_POST["signup"])) {
                $username=strip_tags($_POST["username"]);
                $password=strip_tags($_POST["password"]);
                $password=hash("sha256", $password);
                $fullname=strip_tags($_POST["fullname"]);

                if ($this->model("TaikhoanModel")->checkSignUp($username)==0) {
                    $this->model("TaikhoanModel")->insertUser($username, $password, $fullname);
                    $_SESSION["fullname"]=$fullname;
                    $_SESSION["username"]=$username;
                    $_SESSION["role"]=$this->model("TaiKhoanModel")->getRole($username, $password);
                    $_SESSION["last_login_timestamp"]=time();
                    header("Location: http://localhost/BMW/Home");
                }
                else {
                    $_SESSION["err_signup"]="
                        <div class='main__error-container'>
                            <div class='error'>
                                Tài khoản đã tồn tại, xin vui lòng thử lại
                            </div>
                        </div>
                    ";
                    header("Location: http://localhost/BMW/DangKy");
                }
            }
        }
    }
?>