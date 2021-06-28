<?php
    class Home extends Controller{
        function __construct() {
            $this->view("layout1", [
                "Page" => "home",
            ]);
        }
    }
?>  