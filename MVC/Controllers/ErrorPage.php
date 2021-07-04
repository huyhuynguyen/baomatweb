<?php
    class ErrorPage extends Controller {
        function __construct() {
            $this->view("layout1", [
                "Page" => "errorpage",
                "titlePage" => "Error"
            ]);
        }
    }
?>