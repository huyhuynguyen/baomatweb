<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data["titlePage"] ?></title>
    <link rel="stylesheet" href="http://localhost/BMW/public/css/layout2.css">
    <?php
        if ($data["Page"]=="dangnhap") 
            echo "<link rel='stylesheet' href='http://localhost/BMW/public/css/dangnhap.css'>";
        if ($data["Page"]=="dangky") 
            echo "<link rel='stylesheet' href='http://localhost/BMW/public/css/dangky.css'>";
        if ($data["Page"]=="forgotpassword")
            echo "<link rel='stylesheet' href='http://localhost/BMW/public/css/forgotpassword.css'>";
    ?>
</head>
<body>
    <div class="app">
        <main>
            <div class="main__container">
                <?php
                    require_once "./MVC/Views/Pages/{$data["Page"]}.php";
                ?>
            </div>
            
        </main> 
    </div>

</body>
</html>