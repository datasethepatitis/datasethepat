<?php

$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "bayes_data";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}
$age       = "";
$steorid      = "";
$anorexia     = "";
$alive   = "";
$sukses     = "";
$error      = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if($op == 'delete'){ //untuk hapus
    $id         = $_GET['id'];
    $sql1       = "delete from dataset where id = '$id'";
    $q1         = mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $error  = "Gagal melakukan delete data";
    }
}
if ($op == 'edit') {
    $id         = $_GET['id'];
    $sql1       = "select * from dataset where id = '$id'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $age       = $r1['age'];
    $steroid      = $r1['steroid'];
    $anorexia     = $r1['anorexia'];
    $alive   = $r1['alive'];

    if ($age == '') {
        $error = "Data tidak ditemukan";
    }
}
if (isset($_POST['simpan'])) { //untuk create
    $age       = $_POST['age'];
    $steroid      = $_POST['steroid'];
    $anorexia    = $_POST['anorexia'];
    $alive   = $_POST['alive'];

    if ($age && $steroid && $anorexia && $alive) {
        if ($op == 'edit') { //untuk update
            $sql1       = "update dataset set age = '$age',steroid='$steroid',anorexia = '$anorexia',alive='$alive' where id = '$id'";
            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else { //untuk insert
            $sql1   = "insert into dataset(age,steroid,anorexia,alive) values ('$age','$steroid','$anorexia','$alive')";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses     = "Berhasil memasukkan data baru";
            } else {
                $error      = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silakan masukkan semua data";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dataset Hepatitis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .mx-auto {
            width: 800px
        }

        .card {
            margin-top: 10px;
        }
        h3{
            text-align: center;
        }
    </style>
</head>

<body>


<nav class="nav nav-pills flex-column flex-sm-row">
  <a class="flex-sm-fill text-sm-center nav-link" aria-current="page" href="indexK.php">K-Means Clustering</a>
  <a class="flex-sm-fill text-sm-center nav-link active" href="index.php">Naive Bayes Classifier</a>
    </nav>
    <div class="mx-auto">
        <!-- untuk memasukkan data -->
        
        <div class="card">
            <div class="card-header text-white bg-secondary">
                <a href="index.php">
                    <button type="button" class="btn btn-primary">CEK NAIVES BAYES</button>
                </a> 
            </div>
            <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">AGE</th>
                            <th scope="col">Steroid</th>
                            <th scope="col">Anorexia</th>
                            <th scope="col">Alive</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2   = "select * from dataset order by id asc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)):
                            $id         = $r2['id'];
                            $age       = $r2['age'];
                            $steroid     = $r2['steroid'];
                            $anorexia       = $r2['anorexia'];
                            $alive   = $r2['alive'];

                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $age ?></td>
                                <td scope="row"><?php echo $steroid ?></td>
                                <td scope="row"><?php echo $anorexia ?></td>
                                <td scope="row"><?php echo $alive ?></td>
                                <td scope="row">
                                    <a href="edit.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="dataset.php?op=delete&id=<?php echo $id?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>            
                                </td>
                            </tr>
                        <?php
                        endwhile;
                        ?>
                    </tbody>
                </table>
        </div>
    </div>
</body>

</html>