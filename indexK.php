<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "dataset";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}
$age       = "";
$anorexia      = "";
$steroid     = "";
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
    $sql1       = "delete from hepat where id = '$id'";
    $q1         = mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $error  = "Gagal melakukan delete data";
    }
}
if ($op == 'edit') {
    $id         = $_GET['id'];
    $sql1       = "select * from hepat where id = '$id'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $age       = $r1['age'];
    $anorexia      = $r1['anorexia'];
    $steroid     = $r1['steroid'];
    $alive   = $r1['alive'];

    if ($age == '') {
        $error = "Data tidak ditemukan";
    }
}
if (isset($_POST['simpan'])) { //untuk create
    $age       = $_POST['age'];
    $anorexia       = $_POST['anorexia'];
    $steroid    = $_POST['steroid'];
    $alive   = $_POST['alive'];

    if ($age && $anorexia && $steroid && $alive) {
        if ($op == 'edit') { //untuk update
            $sql1       = "update hepat set age = '$age',anorexia='$anorexia',steroid = '$steroid',alive='$alive' where id = '$id'";
            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else { //untuk insert
            $sql1   = "insert into hepat(age,anorexia,steroid,alive) values ('$age','$anorexia','$steroid','$alive')";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 800px
        }

        .card {
            margin-top: 10px;
        }
    </style>
</head>
<?php
// proses form ketika tombol submit ditekan
if(isset($_POST['simpan'])) {

    // ambil data dari form
    $age = $_POST['age'];
    $anorexia = $_POST['anorexia'];
    $steroid = $_POST['steroid'];

    // cek apakah semua input telah diisi
    if(empty($age) || empty($anorexia) || empty($steroid)) {
        echo "<script>alert('Data belum diisi')</script>";
    } else {
        // simpan data ke dalam database
        $sql = "INSERT INTO hepat (age, anorexia, steroid) VALUES ('$age', '$anorexia', '$steroid')";
        $query = mysqli_query($koneksi, $sql);
        if($query) {
            echo "<script>alert('Data berhasil disimpan')</script>";
        } else {
            echo "<script>alert('Data gagal disimpan')</script>";
        }
    }
}
?>
<body>
    <!-- navbar ini -->
    <nav class="nav nav-pills flex-column flex-sm-row">
  <a class="flex-sm-fill text-sm-center nav-link active" aria-current="page" href="#">K-Means Clustering</a>
  <a class="flex-sm-fill text-sm-center nav-link" href="dataset.php">Naive Bayes Classifier</a>
    </nav>

<br>
<br>

    <div class="mx-auto">
        <!-- untuk memasukkan data -->
        <div class="card">
            <div class="card-header">
                Clustering DATA
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:2;url=indexK.php");//2 : detik
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:2;url=indexK.php");
                }
                ?>
                <form action="dataclust.php" method="POST" name="myForm" onsubmit="return validateForm()">
                    <div class="mb-3 row">
                        <label for="age" class="col-sm-2 col-form-label">AGE</label>
                        <div class="col-sm-10">
                            <input type="" placeholder="Masukan Umur" class="form-control" id="age" name="age" value="<?php echo $age ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="anorexia" class="col-sm-2 col-form-label">Anorexia</label>
                        <div class="col-sm-10">
                            <input type="" placeholder="2=Yes, 1=No" class="form-control" id="anorexia" name="anorexia" value="<?php echo $anorexia ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="steroid" class="col-sm-2 col-form-label">Steroid</label>
                        <div class="col-sm-10">
                            <input type="" placeholder="2=Yes, 1=No" class="form-control" id="steroid" name="steroid" value="<?php echo $steroid ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="INPUT DATA DAN CEK CLUSTERING" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>

        <!-- untuk mengeluarkan data -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Dataset Hepatitis
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">AGE</th>
                            <th scope="col">Anorexia</th>
                            <th scope="col">Steroid</th>
                            <th scope="col">Alive</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2   = "select * from hepat order by id asc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id         = $r2['id'];
                            $age       = $r2['age'];
                            $anorexia       = $r2['anorexia'];
                            $steroid     = $r2['steroid'];
                            $alive   = $r2['alive'];

                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $age ?></td>
                                <td scope="row"><?php echo $anorexia ?></td>
                                <td scope="row"><?php echo $steroid ?></td>
                                <td scope="row"><?php echo $alive ?></td>
                                <td scope="row">
                                    <a href="editK.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="indexK.php?op=delete&id=<?php echo $id?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>            
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script>
    function validateForm() {
    var age = document.forms["myForm"]["age"].value;
    var anorexia = document.forms["myForm"]["anorexia"].value;
    var steroid = document.forms["myForm"]["steroid"].value;
    if (age == "" || anorexia == "" || steroid == "") {
        alert("Data belum diisi, harap memasukan data dengan benar dan terisi semua");
        return false;
    }
    if (anorexia != "1" && anorexia != "2") {
        alert("Masukan data yang benar untuk Anorexia (1 atau 2)");
        return false;
    }
    if (steroid != "1" && steroid != "2") {
        alert("Masukan data yang benar untuk Steroid (1 atau 2)");
        return false;
    }
}
</script>

</html>