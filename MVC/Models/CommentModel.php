<?php
    class CommentModel extends DB {
        function getAllCommentForPost($id) {
            $qr="SELECT cm.id, cm.idtin, cm.noidung, u.fullname, u.avatar FROM comment cm, user u WHERE cm.username=u.username AND idtin='$id'";
            $result=$this->conn->query($qr);
            $arr=[];
            while($row=$result->fetch_assoc()) {
                $idComment=$row["id"];
                $qr1="SELECT ph.id, ph.noidung, ph.idcomment, u.fullname, u.avatar FROM phanhoi ph, user u WHERE ph.username=u.username AND idcomment='$idComment'";
                $resultPhanHoi=$this->conn->query($qr1);
                $arrPhanHoi=[];
                while($rowPhanHoi=$resultPhanHoi->fetch_assoc()) {
                    array_push($arrPhanHoi, $rowPhanHoi);
                }
                $row["arrPhanHoi"]=$arrPhanHoi;
                array_push($arr, $row);
            }
            return json_encode($arr);
        }

        function InsertComment($noidung, $username, $idtin) {
            $qr="INSERT INTO comment (noidung, username, idtin) VALUES('$noidung', '$username', '$idtin')";
            $this->conn->query($qr);

            $qr1="SELECT id, noidung FROM comment WHERE noidung='$noidung' AND username='$username' AND idtin='$idtin'";
            $result=$this->conn->query($qr1);
            $row=$result->fetch_assoc();
            return $row;
        }
    }
?>