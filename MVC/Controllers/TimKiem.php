<?php
    class TimKiem extends Controller {
        function Search($searchText) {
            $this->view("layout1", [
                "Page" => "timkiem",
                "arrSearchTintuc" => $this->model("TinTucModel")->searchTinTuc($searchText)
            ]);
        }
    }

?>