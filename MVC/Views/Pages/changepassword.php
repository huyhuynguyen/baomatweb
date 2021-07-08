<?php
    if (!isset($_SESSION["username"])) 
        header("Location: http://localhost/BMW/DangNhap");
?>

<div>
    <div class="main__title-header">
        <h2 class="main__title-heading">Quên Mật Khẩu</h2>
    </div>

    <div class="main__form_container">
        <?php
            if (isset($_SESSION["err_username"])) {
                echo $_SESSION["err_username"];
            }
        ?>
        <form action="./ChangePassword/XuLyChangePassword" method="post" class="main__form-resetpassword">
            <div class="form__resetpassword-group">
                <label for="username">Username (*): </label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="form__resetpassword-group">
                <label for="username">Old password (*): </label>
                <input type="password" name="password" id="old_password" required>
            </div>
            <div class="form__resetpassword-group">
                <label for="password">New Password (*): </label>
                <input type="password" name="new_password" id="password" required>
                <div class="password_check-container">
                    <span id="password_check">Lưu ý: Mật khẩu ít nhất 8 ký tự gồm: chữ thường, số, in hoa và ký tự đặc biệt</span>
                </div>
            </div>
            <div class="form__resetpassword-group">
                <label for="retype-password">Confirm Password (*): </label>
                <input type="password" name="retype-password" id="retype-password" required>
                <div class="error__retypePassword-container"></div>
                
            </div>
            <div class="form__resetpassword-group">
                <input type="submit" value="Change Password" name="change_password">
            </div>
        </form>

        <div class="main__back-container">
            <a href="http://localhost/BMW/Home" class="main__login-link">Quay lại</a>
        </div>
    </div>
</div>

<script>
    window.onload=function() {
        <?php
            unset($_SESSION["err_username"]);
        ?>
    }

    var usernameElement=document.querySelector('input[id="username"]');
    usernameElement.value=
        <?php 
            if (isset($_SESSION["username"])) 
                echo json_encode($_SESSION["username"]);
        ?>

    var checkRetype=false;
    var retypePasswordElement=document.querySelector('input[id="retype-password"]');
    retypePasswordElement.oninput=function(e) {
        var passwordElement=document.querySelector('input[id="password"]');
        if (e.target.value!==passwordElement.value) {
            e.target.nextElementSibling.innerHTML="<span class='error__retypePassword'>**Password are not matching</span>";
            checkRetype=false;
        }
        else {
            e.target.nextElementSibling.querySelector('.error__retypePassword').remove();
            checkRetype=true;
        }
    }

    var formElement=document.querySelector('.main__form-resetpassword');
    formElement.onsubmit=function(e) {
        var passwordElement=e.target.querySelector('input[id="password"]');
        if (checkRetype==true && (/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W)/.test(passwordElement.value) && password.value.length>=8))
            e.submit();
        else {
            e.preventDefault();
            alert("Vui lòng nhập đúng mật khẩu hoặc format mật khẩu");
        }
    }
</script>