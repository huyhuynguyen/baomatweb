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
        <form action="./DangNhap/XuLyDangNhap" method="post" class="main__form-login">
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
</script>