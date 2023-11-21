<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prak 7</title>
    <style>
        .inputValue {
            background-color: #B4B4B3;
            width: 60%;
            padding: 20px;
            border-radius: 10px;
        }
        input {
            width: auto;
            padding: 2px;
        }
        label{
            width: 30%;
        }
        span {
            margin-right: 5px;
        }
        .inputform {
            display: flex;
            margin-bottom: 7px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .create, .edit, .hapus{
            background: gray;
            border: none;
            border-radius: 3px;
            color: white;
            padding: 3px 5xp;
            margin-bottom: 10px;
        }
        .display{
            display: flex;
            flex-direction: column;
            margin-bottom: 10px;
        }

        .dis{
            display: flex;
            width: 50%;
        }

    </style>
</head>
<body>
    <form method="post" action="">
        <select name="search" id="search">
            <option value="">Semua</option>
            <option value="140">Teknik Informatika : 140</option>
            <option value="120">Teknik Biomedi : 120</option>
            <option value="130">Teknik Elektro : 130</option>
            <option value="100">Teknik Geologi : 10</option>
        </select>
        <input type="submit" name="submit" value="Cari">
    </form><br>

    <button class="create" onclick="forCreate()">Create</button>
    <button class="edit">Edit</button>
    
    <div class="displayInputFrame"></div>

    <?php
        include 'prak7_connection.php';
        $search = isset($_POST['search']) ? $connect->real_escape_string($_POST['search']) : '';
        
        $sql = "SELECT * FROM prak";

        if (!empty($search)) {
            $sql .= " WHERE kode LIKE '%$search%'";
        }

        $result = $connect->query($sql);
        
        $data = array(); 
        
        if ($result->num_rows > 0) {
            while ($get_row = $result->fetch_assoc()) {
                $data[] = array(
                    'nim' => $get_row['nim'],
                    'nama' => $get_row['nama'],
                    'kode' => $get_row['kode']
                );
        
                echo "
                    <section class='display' id='display'>
                        <div class='dis'>
                            <label>NIM</label><span>:</span>{$get_row['nim']}
                        </div>
                        <div class='dis'>
                            <label>Nama</label><span>:</span>{$get_row['nama']}
                        </div>
                        <div class='dis'>
                            <label>Kode Prodi</label><span>:</span>{$get_row['kode']}
                        </div>
                    </section>
                ";
                echo "<form method='post' action='prak7_delete.php'>
                        <input type='hidden' name='nim' value='" . $get_row['nim'] . "'>
                        <input class='hapus' type='submit' value='Hapus'>
                    </form>
                    <button class='edit' onclick='showEdit(" . $get_row['nim'] . ")'>Edit</button><br><br>

                    <div id='editForm{$get_row['nim']}' style='display:none;'>
                        <form class='inputValue' method='post' action='prak7_edit.php'>
                            <div class='inputform'>
                                <label for=''>NIM</label><span>:</span>
                                <input type='text' name='nim' value='{$get_row['nim']}'>
                            </div>

                            <div class='inputform'>
                                <label for=''>Nama</label><span>:</span>
                                <input type='text' name='nama' id='nama' value='{$get_row['nama']}'>
                            </div>

                            <div class='inputform'>                                
                                <label for=''>Kode Prodi</label><span>:</span>
                                <input type='text' name='kode' id='kode' value='{$get_row['kode']}'>
                            </div>

                            <input class='create' type='submit' value='Simpan Perubahan'>
                        </form>
                    </div>
                ";
            }
        }  
    ?>

    <script>
            function forCreate(){
                let html = `
                    <form class="inputValue" action="prak7_create.php" method="POST">
                        <div class="inputform">
                            <label for="">NIM</label><span>:</span> 
                            <input type="text" name="nim" id="nim" placeholder="contoh : 121140087" required>
                        </div>
                        <div class="inputform">
                            <label for="">Nama Lengkap</label><span>:</span> 
                            <input type="text" name="nama" id="nama" required>
                        </div>
                        <div class="inputform">
                            <label for="">Kode Prodi</label><span>:</span> 
                            <input style="width: 163px;" type="text" name="kode" id="kode">
                        </div>
                        <input style="width: 60px;" type="submit" name="submit" id="submit">
                    </form>
                `;
                document.querySelector('.displayInputFrame').innerHTML = html;
            }
            function showEdit(nim) {
                document.querySelectorAll('[id^="editForm"]').forEach(form => {
                    form.style.display = 'none';
                });

                document.getElementById(`editForm${nim}`).style.display = 'block';
            }
        </script>
</body>
</html>
