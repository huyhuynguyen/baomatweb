<?php
    class ResponseModel extends DB {
        function InsertResponse($noidung, $username, $idcomment) {
            $qr="INSERT INTO phanhoi (noidung, username, idcomment) VALUES('$noidung', '$username', '$idcomment')";
            $this->conn->query($qr);

            $qr1="SELECT ph.id, ph.noidung, ph.idcomment, u.fullname, u.avatar FROM phanhoi ph, user u WHERE ph.username=u.username AND idcomment='$idcomment'";
            $result=$this->conn->query($qr1);
            $arr=[];
            while($row=$result->fetch_assoc()) {
                array_push($arr, $row);
            }
            return $arr;
        }   
    }
?>