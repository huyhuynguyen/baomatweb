<div>
    <div class="main__title-header">
        <h2 class="main__title-heading">Đăng Ký</h2>
    </div>
    <div class="main__form_container">
        <?php
            if (isset($_SESSION["err_signup"])) {
                echo $_SESSION["err_signup"];
            }
        ?>

        <form action="./DangKy/XuLyDangKy" method="post" class="main__form-signup">
            <div class="form__signup-group">
                <label for="username">Username (*): </label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="form__signup-group">
                <label for="password">Password (*): </label>
                <input type="password" name="password" id="password" required>
                <div class="password_check-container">
                    <span id="password_check">Lưu ý: Mật khẩu ít nhất 8 ký tự gồm: chữ thường, số, in hoa và ký tự đặc biệt</span>
                </div>
            </div>
            <div class="form__signup-group">
                <label for="fullname">Fullname (*): </label>
                <input type="text" name="fullname" id="fullname" required>
            </div>
            <div class="form__signup-group">
                <input type="submit" value="Sign up" name="signup">
            </div>
        </form>

        <div class="main__no-account-container">
            <p class="main__has-account-text">Đã có tài khoản?</p>
            <a href="http://localhost/BMW/DangNhap" class="main__login-link">Login</a>
        </div>
    </div>
</div>

<script>
    window.onload=function() {
        <?php
            unset($_SESSION["err_signup"]);
        ?>
    }

    var formElement=document.querySelector('.main__form-signup');
    formElement.onsubmit=function(e) {
        var passwordElement=e.target.querySelector('input[id="password"]');
        if (/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W)/.test(passwordElement.value) && password.value.length>=8)
            e.submit();
        else {
            e.preventDefault();
            alert("Mật khẩu không đúng format");
        }
    }
</script>