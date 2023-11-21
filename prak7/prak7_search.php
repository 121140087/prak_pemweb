<?php

include "prak7_connection.php";

$search = $_POST['search'];

$sql = "SELECT * FROM prak 
        WHERE prodi LIKE '%$search%'";

$result = $connect->query($sql);

if($result->num_rows > 0){
    $data = array();
    while($get_row = $result->fetch_assoc()){
        $data[] = $get_row;
    }
}