<?php

include "prak7_connection.php";

$nim = $_POST['nim'];

$sql = "DELETE FROM prak WHERE nim = '$nim'";

$result = $connect->query($sql);

if($result){
    echo '<script>alert("Data dihapus");
    window.location.href = "prak7.php";
    </script>';
}