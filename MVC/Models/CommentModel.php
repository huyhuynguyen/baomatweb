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

        function InsertComment($noidung, $idtin) {
            $qr="INSERT INTO comment (noidung, username, idtin) VALUES(?, ?, ?)";
            $stmt = $this->conn->prepare($qr);
            $stmt->bind_param("ssi", $noidung, $_SESSION["username"], $idtin);
            $stmt->execute();

            $qr1="SELECT id, noidung FROM comment WHERE noidung=? AND username=? AND idtin=?";
            $stmt1 = $this->conn->prepare($qr1); 
            $stmt1->bind_param("ssi", $noidung, $_SESSION["username"], $idtin);
            $stmt1->execute();
            $result = $stmt1->get_result();

            $row=$result->fetch_assoc();
            return $row;
        }
    }
?>