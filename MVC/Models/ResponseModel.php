<?php
    class ResponseModel extends DB {
        function InsertResponse($noidung, $idcomment) {
            $qr="INSERT INTO phanhoi (noidung, username, idcomment) VALUES(?, ?, ?)";
            $stmt = $this->conn->prepare($qr);
            $stmt->bind_param("ssi", $noidung, $_SESSION["username"], $idcomment);
            $stmt->execute();

            $qr1="SELECT ph.id, ph.noidung, ph.idcomment, u.fullname, u.avatar FROM phanhoi ph, user u WHERE ph.username=u.username AND idcomment=?";
            $stmt1 = $this->conn->prepare($qr1); 
            $stmt1->bind_param("i", $idcomment);
            $stmt1->execute();
            $result = $stmt1->get_result();
            $arr=[];
            while($row=$result->fetch_assoc()) {
                array_push($arr, $row);
            }
            return $arr;
        }   
    }
?>