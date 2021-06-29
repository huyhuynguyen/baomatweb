<?php
    class TinTucModel extends DB {
        function getAllTinTuc() {
            $qr="SELECT * FROM tintuc";
            $stmt=$this->conn->prepare($qr);
            $stmt->execute();
            $result = $stmt->get_result();
            $arr=[];
            while($row=$result->fetch_assoc()) {
                $obj = array(
                    "id" => $row["id"],
                    "tieude" => $row["tieude"],
                    "noidung" => $row["noidung"],
                    "hinhanh" => $row["hinhanh"]
                );
                array_push($arr, $obj);
            }
            return json_encode($arr);
        }   

        function getTinTucById($id) {
            $qr="SELECT tt.*,ltt.theloai FROM tintuc tt, loaitintuc ltt WHERE tt.idloai=ltt.id AND tt.id=?";
            $stmt=$this->conn->prepare($qr);
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows==0)
                return null;
            
            $row=$result->fetch_assoc();
            $obj=array(
                "id" => $row["id"],
                "tieude" => $row["tieude"],
                "noidung" => $row["noidung"],
                "hinhanh" => $row["hinhanh"],
                "theloai" => $row["theloai"],
                "idloai" => $row["idloai"]
            );
            return json_encode($obj);
        }

        function checkTrungNhau($tieude, $noidung) {
            $qr="SELECT * FROM tintuc WHERE tieude=? AND noidung=?";
            $stmt=$this->conn->prepare($qr);
            $stmt->bind_param("ss", $tieude, $noidung);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->num_rows;
        }

        function InsertNews($tieude, $noidung, $hinhanh, $idloai) {
            $qr="INSERT INTO tintuc (tieude, noidung, hinhanh, idloai) VALUES(?, ?, ?, ?)";
            $stmt = $this->conn->prepare($qr);
            $stmt->bind_param("sssi", $tieude, $noidung, $hinhanh, $idloai);
            $stmt->execute();
        }

        // ajax goi delete
        function DeleteNews($id) {
            $qr="DELETE FROM  tintuc WHERE id=?";
            $stmt = $this->conn->prepare($qr);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            // $qr="DELETE FROM  tintuc WHERE id='$id'";
            // $result=$this->conn->query($qr);
            return TRUE;
        }

        function UpdateNews($id, $tieude, $noidung, $hinhanh, $idloai) {
            $qr="UPDATE tintuc SET tieude=?, noidung=?, hinhanh=?, idloai=? WHERE id=?";
            $stmt = $this->conn->prepare($qr);
            $stmt->bind_param("sssii", $tieude, $noidung, $hinhanh, $idloai, $id);
            $stmt->execute();
            $result = $stmt->get_result();
            // $qr="UPDATE tintuc SET tieude='$tieude', noidung='$noidung', hinhanh='$hinhanh', idloai='$idloai' WHERE id='$id'";
            // $result=$this->conn->query($qr);
            return TRUE;
        }

        function getAllTheLoai() {
            $qr="SELECT * FROM loaitintuc";
            $stmt=$this->conn->prepare($qr);
            $stmt->execute();
            $result = $stmt->get_result();
            $arr=[];
            while($row=$result->fetch_assoc()) {
                $obj = array(
                    "id" => $row["id"],
                    "theloai" => $row["theloai"],
                );
                array_push($arr, $obj);
            }
            return json_encode($arr);
        }

        function searchTinTuc($searchText) {
            $_SESSION["timkiem"]=$searchText;
            $qr="SELECT * FROM tintuc WHERE tieude LIKE '%$searchText%'";
            $result=$this->conn->query($qr);
            $arr=[];
            while($row=$result->fetch_assoc()) {
                $row["id"]=(int)$row["id"];
                $row["idloai"]=(int)$row["idloai"];
                array_push($arr, $row);
            }
            return json_encode($arr);
        }
        
    }
?>