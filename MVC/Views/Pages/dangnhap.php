<div>
    <div class="main__title-header">
        <h2 class="main__title-heading">Đăng Nhập</h2>
    </div>
    <div class="main__form_container">
        <?php
            if (isset($_SESSION["err_login"])) {
                echo $_SESSION["err_login"];
            }
        ?>
        <form action="./DangNhap/XuLyDangNhap" method="post" class="main__form-login" id="form-login">
            <div class="form__login-group">
                <label for="username">Username (*): </label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="form__login-group">
                <label for="password">Password (*): </label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form__login-group">
                <input type="submit" value="Login" name="login">
            </div>
        </form>
        <div class="main__remember-forgot-container">
            <div class="main__remember-username-container">
                <input type="checkbox" name="remember_username" id="remember_username" form="form-login">
                <label class="main__remember-username" for="remember_username">Nhớ tài khoản</label>
            </div>
            <div class="main__forgot-password-container">
                <a href="http://localhost/BMW/ForgotPassword" class="main__forgot-password-link">Quên mật khẩu?</a>
            </div>
        </div>
        
        <div class="main__no-account-container">
            <p class="main__no-account-text">Chưa có tài khoản?</p>
            <a href="http://localhost/BMW/DangKy" class="main__signUp-link">Sign Up</a>
        </div>
    </div>
    
</div>

<script>
    window.onload=function() {
        <?php
            unset($_SESSION["err_login"]);
        ?>
    }

    var inputUsernameElement=document.querySelector('input[name="username"]');
    inputUsernameElement.value=<?php 
        if (isset($_SESSION["save_username"])) 
            echo json_encode($_SESSION["save_username"]); 
        else echo json_encode("");
        ?>;
    var inputCheckboxElement=document.querySelector('input[name="remember_username"]');
    inputCheckboxElement.checked=<?php 
        if (isset($_SESSION["save_username"])) 
            echo json_encode(TRUE); 
        else echo json_encode(FALSE);
        ?>;
</script>