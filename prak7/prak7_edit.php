<?php

include "prak7_connection.php";

$nim = $_POST['nim'];
$nama = $_POST['nama'];
$kode = $_POST['kode'];

$sql = "UPDATE prak SET
        nim = '$nim', nama = '$nama', kode = '$kode'
        WHERE nim = '$nim'";

$result = $connect->query($sql);
if($result){
    echo '<script>alert("Data berhasil diedit");
    window.location.href = "prak7.php";
    </script>';
}