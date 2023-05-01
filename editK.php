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
<html>
<head>
	<title>Edit Dataset</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<style>
		body {
			padding: 50px;
		}
		form {
			max-width: 500px;
			margin: 0 auto;
		}
		h2 {
			text-align: center;
			margin-bottom: 30px;
		}
		label {
			font-weight: bold;
		}
		input[type=text] {
			padding: 10px;
			border-radius: 5px;
			border: none;
			background-color: #f2f2f2;
			margin-bottom: 20px;
		}
		input[type=submit] {
			background-color: #007bff;
			color: #fff;
			padding: 10px 20px;
			border-radius: 5px;
			border: none;
			cursor: pointer;
			margin-right: 10px;
		}
		a {
			color: #007bff;
			text-decoration: none;
		}
        p{
            color: grey;
            text-align: center;
        }
	</style>
</head>
<body>
<div class="container">
  <h2>Edit Dataset</h2>
  <?php
    if ($error) {
      echo "<div class='alert alert-danger'>$error</div>";
    }
    if ($sukses) {
      echo "<div class='alert alert-success'>$sukses</div>";
    }
  ?>
  <form method="post">
  <div class="form-group">
  <p>NB: Untuk edit data, pastikan nilai yang diinput pada Anorexia atau Steroid berupa 1 atau 2</p>
  </div>
    <div class="form-group">
      <label for="age">Age:</label>
      <input type="text" class="form-control" id="age" name="age" value="<?php echo $age; ?>">
    </div>
    <div class="form-group">
      <label for="anorexia">Anorexia:</label>
      <input type="text" class="form-control" id="anorexia" name="anorexia" value="<?php echo $anorexia; ?>">
    </div>
    <div class="form-group">
      <label for="steroid">Steroid:</label>
      <input type="text" class="form-control" id="steroid" name="steroid" value="<?php echo $steroid; ?>">
    </div>
    <div class="form-group">
      <label for="alive">Alive:</label>
      <input type="text" class="form-control" id="alive" name="alive" value="<?php echo $alive; ?>">
    </div>
    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
    <a href="indexK.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
</body>
</html>