<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <?php
        if (!isset($_SESSION["username"])) {
            header("Location: http://localhost/BMW/Unset");
        }
    ?>

    <div>
        <div>
            <a href="http://localhost/BMW/Home">Home Page</a>
        </div>
        <div>
            <p>Fullname: <span><?php echo $_SESSION["fullname"] ?></span></p>
        </div>
        <div>
            <button id="logout">Logout</button>
        </div>
    </div>

    <div>
        <?php
            require_once "./MVC/Views/Pages/{$data['Page']}.php";
        ?>
    </div>

    <script>
        var btn=document.querySelector('#logout');
        btn.onclick=function(e) {
            window.location="http://localhost/BMW/Unset";
        }
    </script>
</body>
</html>