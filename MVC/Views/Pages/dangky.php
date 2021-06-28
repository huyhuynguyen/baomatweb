<div>
    <div>
        <div>
            <?php
                if (isset($_SESSION["err_signup"])) {
                    echo $_SESSION["err_signup"];
                }
            ?>
        </div>
    </div>

    <form action="./DangKy/XuLyDangKy" method="post">
        <div>
            <label for="username">Username: </label>
            <input type="text" name="username" id="username">
        </div>
        <div>
            <label for="password">Password: </label>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <label for="fullname">Fullname: </label>
            <input type="text" name="fullname" id="fullname">
        </div>
        <div>
            <input type="submit" value="SignUp" name="signup">
        </div>
    </form>

    <div>
        <p>Đã có tài khoản?</p>
        <a href="http://localhost/BMW/DangNhap">Login</a>
    </div>
</div>

<script>
    window.onload=function() {
        <?php
            unset($_SESSION["err_signup"]);
        ?>
    }
</script>