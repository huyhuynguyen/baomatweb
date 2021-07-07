<?php
    class ForgotPassword extends Controller {
        function __construct() {
            $this->view("layout2", [
                "Page" => "forgotpassword",
                "titlePage" => "Quên mật khẩu"
            ]);
        }

        function XuLyForgotPassword() {
            if (isset($_POST["reset_password"])) {
                $username=strip_tags($_POST["username"]);
                $password=strip_tags($_POST["password"]);
                $password=hash("sha256", $password);
                $retype_password=strip_tags($_POST["retype-password"]);

                $result = $this->model("TaiKhoanModel")->ResetPassword($username, $password);
                // check if affect 1 row or 0 row
                if ($result==1) {
                    header("Location: http://localhost/BMW/DangNhap");
                }
                else{
                    $_SESSION["err_username"]="
                        <div class='main__error-container'>
                            <div class='error'>
                                Username is wrong
                            </div>
                        </div>
                    ";
                    header("Location: http://localhost/BMW/ForgotPassword");
                }
            }
        }
    }
?>