<?php
    $connect=mysqli_connect("localhost","root","","little_kids");
    $connect->set_charset("utf8");
    $selectadb=mysqli_select_db($connect,"little_kids");
    if(!$connect){
        echo "ไม่สามารถเชื่อมต่อได้";
    }

?>