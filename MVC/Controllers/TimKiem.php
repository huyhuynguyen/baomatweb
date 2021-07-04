<?php
    class TimKiem extends Controller {
        function Search($searchText) {
            $this->view("layout1", [
                "Page" => "timkiem",
                "titlePage" => "Tìm kiếm",
                "arrSearchTintuc" => $this->model("TinTucModel")->searchTinTuc(strip_tags($searchText))
            ]);
        }
    }

?>