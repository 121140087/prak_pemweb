<?php

include "prak7_connection.php";

$nim = $_POST['nim'];
$nama = $_POST['nama'];
$kode = $_POST['kode'];

$sql = "INSERT INTO prak
        VALUES('$nim', '$nama', '$kode')";

$result = mysqli_query($connect, $sql);

if($result){
    echo '<script>alert("Data berhasil ditambahkan");
    window.location.href = "prak7.php";
    </script>';
}else{
    echo '<script>alert("Data gagal ditambahkan");
    window.location.href = "prak7.php";
    </script>';
}
?>