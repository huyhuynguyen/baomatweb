<?php
    class ChangePassword extends Controller {
        function __construct() {
            $this->view("layout2", [
                "Page" => "changepassword",
                "titlePage" => "Đổi mật khẩu"
            ]);
        }

        function XuLyChangePassword() {
            if (isset($_POST["change_password"])) {
                $username=strip_tags($_POST["username"]);
                $oldpassword=strip_tags($_POST["password"]);
                $new_password=strip_tags($_POST["new_password"]);
                $oldpassword=hash("sha256", $oldpassword);
                $new_password=hash("sha256", $new_password);
                $retype_password=strip_tags($_POST["retype-password"]);

                $result = $this->model("TaiKhoanModel")->ChangePassword($username, $oldpassword, $new_password);
                // check if affect 1 row or 0 row
                if ($result==1) {
                    header("Location: http://localhost/BMW/Home");
                }
                else{
                    $_SESSION["err_username"]="
                        <div class='main__error-container'>
                            <div class='error'>
                                Username or password is wrong
                            </div>
                        </div>
                    ";
                    header("Location: http://localhost/BMW/ChangePassword");
                }
            }
        }
    }
?>