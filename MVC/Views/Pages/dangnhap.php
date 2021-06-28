<div>
    <div>
        <div>
            <?php
                if (isset($_SESSION["err_login"])) {
                    echo $_SESSION["err_login"];
                }
            ?>
        </div>
    </div>
    <form action="./DangNhap/XuLyDangNhap" method="post">
        <div>
            <label for="username">Username: </label>
            <input type="text" name="username" id="username">
        </div>
        <div>
            <label for="password">Password: </label>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <input type="submit" value="Login" name="login">
        </div>
    </form>

    <div>
        <p>Chưa có tài khoản?</p>
        <a href="http://localhost/BMW/DangKy">Sign Up</a>
    </div>
</div>

<script>
    window.onload=function() {
        <?php
            unset($_SESSION["err_login"]);
        ?>
    }
</script>