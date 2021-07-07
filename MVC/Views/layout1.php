<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data["titlePage"] ?></title>
    <link rel="stylesheet" href="http://localhost/BMW/public/css/layout1.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <?php
        if ($data["Page"]=="home") {
            echo "<link rel='stylesheet' href='http://localhost/BMW/public/css/home.css'>";
        }
        if ($data["Page"]=="tintuc") {
            echo "<link rel='stylesheet' href='http://localhost/BMW/public/css/tintuc.css'>";
        }
        if ($data["Page"]=="timkiem") {
            echo "<link rel='stylesheet' href='http://localhost/BMW/public/css/timkiem.css'>";
        }
        if ($data["Page"]=="them_tintuc") {
            echo "<link rel='stylesheet' href='http://localhost/BMW/public/css/themtintuc.css'>";
        }
        if ($data["Page"]=="sua_tintuc") {
            echo "<link rel='stylesheet' href='http://localhost/BMW/public/css/suatintuc.css'>";
        }
        if ($data["Page"]=="detail_tintuc") {
            echo "<link rel='stylesheet' href='http://localhost/BMW/public/css/detailtintuc.css'>";
        }
        if($data["Page"]=="errorpage") {
            echo "<link rel='stylesheet' href='http://localhost/BMW/public/css/errorpage.css'>";
        }
    ?>
</head>
<body>
    <?php
        // auto logout after 15 minutes with inactivity
        if (isset($_SESSION["username"])) {
            if (time() - $_SESSION["last_login_timestamp"] > 900) {
                header("Location: http://localhost/BMW/Unset");
            }
            else {
                $_SESSION["last_login_timestamp"]=time();
            }
        }   
        else {
            header("Location: http://localhost/BMW/Unset");
        }

    ?>
    <div class="app">
        <header>
            <div class="header__container">
                <div>
                    <div class="header__logo-image-container">
                        <div>
                            <a href="http://localhost/BMW/Home">
                                <img src="http://localhost/BMW/public/images/newspaper.png" alt="" class="header__logo-image">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="header__content-btnLogout-container">
                    <div>
                        <p>Fullname: <span><?php echo $_SESSION["fullname"] ?></span></p>
                    </div>
                    <div class="header__logoutBtn-container">
                        <a href="http://localhost/BMW/Unset" class="header__logoutBtn-link">
                            <button id="logout" class="header__logoutBtn">Logout</button>
                        </a>
                    </div>
                </div>
                
            </div>
        </header>
        
        
        <main>
            <div>
                <?php
                    require_once "./MVC/Views/Pages/{$data['Page']}.php";
                ?>
            </div>
        </main>
        
        <footer>
            <div class="footer__container">
                <div class="footer__content-info-container">
                    <div class="footer__content-info-image-container">
                        <div>
                            <img src="http://localhost/BMW/public/images/newspaper.png" alt="" class="footer__content-image">
                        </div>
                        <div>
                            <p class="footer__content-image-brand">NewNews</p>
                        </div>
                    </div>

                    <div class="footer__content-info">
                        <p>Owner: <b>Admin</b></p>
                        <p>NewNews cung cấp những thông tin chính xác và nhanh nhất đến với độc giả</p>
                    </div>
                </div>

                <div class="footer__copyrightInfo-container">
                        <div class="footer__copyrightInfo">
                            <span>Bản quyền ©1995-2020 NewNews bảo lưu mọi quyền</span>
                        </div>

                        <ul class="footer__copyrightInfo-list">
                            <li class="footer__copyrightInfo-item">
                                <a href="#" class="footer__copyrightInfo-item-link">Contact</a>
                            </li>
                            <li class="footer__copyrightInfo-item">
                                <a href="#" class="footer__copyrightInfo-item-link">Terms of Use</a>
                            </li>
                            <li class="footer__copyrightInfo-item">
                                <a href="#" class="footer__copyrightInfo-item-link">Privacy</a>
                            </li>
                            <li class="footer__copyrightInfo-item">
                                <a href="#" class="footer__copyrightInfo-item-link">Cookies</a>
                            </li>
                        </ul>
                    </div>
            </div>
        </footer>
    </div>
</body>
</html>