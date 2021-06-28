<?php
    class TinTuc extends Controller {
        function NewsList() {
            $arrTinTuc=$this->model("TinTucModel")->getAllTinTuc();
            $this->view("layout1", [
                "Page" => "tintuc",
                "arrTinTuc" => $arrTinTuc
            ]);
        }
        
        function Detail($id) {
            $itemTin=$this->model("TinTucModel")->getTinTucById($id);
            $currentUser=$this->model("TaiKhoanModel")->getCurrentUser();
            $arrComment=$this->model("CommentModel")->getAllCommentForPost($id);
            $this->view("layout1", [
                "Page" => "detail_tintuc",
                "itemTin" => $itemTin,
                "currentUser" => $currentUser,
                "arrComment" => $arrComment
            ]);
        }

        function ThemTinTuc() {
            $this->view("layout1", [
                "Page" => "them_tintuc",
                "arrCategories" => $this->model("TinTucModel")->getAllTheLoai()
            ]);
        }

        function XuLyThemTinTuc() {
            if (isset($_POST["create"])) {
                $tieude=$_POST["title"];
                $noidung=$_POST["content"];
                $theloai=$_POST["categories"];
                $hinhanh=$_POST["image"];

                $result=$this->model("TinTucModel")->checkTrungNhau($tieude, $noidung);
                // check thêm thành công
                if ($result==0) {
                    if (isset($_SESSION["err_createNews"])) {
                        unset($_SESSION["err_createNews"]); 
                    }

                    // insert
                    $this->model("TinTucModel")->InsertNews($tieude, $noidung, $hinhanh, $theloai);
                    header("Location: http://localhost/BMW/TinTuc/NewsList");
                }
                else {
                    $_SESSION["err_createNews"]="Thêm tin tức bị lỗi";
                    header("Location: http://localhost/BMW/TinTuc/ThemTinTuc");
                }
            }
        }

        function XoaTinTuc() {
            $idTinTuc=$_POST["id"];
            $result=$this->model("TinTucModel")->DeleteNews($idTinTuc);
            echo $result;
        }

        function SuaTinTuc($id) {
            $this->view("layout1", [
                "Page" => "sua_tintuc",
                "itemTin" => $this->model("TinTucModel")->getTinTucById($id),
                "arrCategories" => $this->model("TinTucModel")->getAllTheLoai()
            ]);
        }

        function XuLySuaTinTuc($id) {
            if (isset($_POST["update"]) && $_POST["update"]=="Update") {
                $tieude=$_POST["title"];
                $noidung=$_POST["content"];
                $hinhanh=$_POST["imageName"];
                $idloai=$_POST["categories_update"];
                
                $result = $this->model("TinTucModel")->UpdateNews($id, $tieude, $noidung, $hinhanh, $idloai);
                if ($result)
                    header("Location: http://localhost/BMW/TinTuc/Detail/{$id}");       
            }
        }

        function InsertComment() {
            $noidung=$_POST["noidung"];
            $username=$_POST["username"];
            $idtin=$_POST["idtin"];

            $result = $this->model("CommentModel")->InsertComment($noidung, $username, $idtin);
            echo json_encode($result);
        }

        function InsertPhanHoi() {
            $noidung=$_POST["noidung"];
            $username=$_POST["username"];
            $idcomment=$_POST["idcomment"];

            $result=$this->model("ResponseModel")->InsertResponse($noidung, $username, $idcomment);
            
            echo $noidung;
        }
    }
?>