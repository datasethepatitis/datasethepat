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
$steroid   = "";
$anorexia  = "";
$alive     = "";
$sukses    = "";
$error     = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'edit') {
    $id         = $_GET['id'];
    $sql1       = "select * from dataset where id = '$id'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $age        = $r1['age'];
    $steroid    = $r1['steroid'];
    $anorexia   = $r1['anorexia'];
    $alive      = $r1['alive'];

    if ($age == '') {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) {
    $age       = $_POST['age'];
    $steroid   = $_POST['steroid'];
    $anorexia  = $_POST['anorexia'];
    $alive     = $_POST['alive'];

    if ($age && $steroid !== '' && $anorexia !== '' && $alive) {
        if ($op == 'edit') {
            $sql1  = "update dataset set age = '$age', steroid='$steroid', anorexia = '$anorexia', alive='$alive' where id = '$id'";
            $q1    = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else {
            $sql1   = "insert into dataset(age, steroid, anorexia, alive) values ('$age','$steroid','$anorexia','$alive')";
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
</head>
<body>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Dataset</title>
	<!-- Include Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<div class="container mt-5">
		<h2>Edit Dataset</h2>

		<?php
		if ($error) {
			echo "<p class='text-danger'>$error</p>";
		}
		if ($sukses) {
			echo "<p class='text-success'>$sukses</p>";
		}
		?>

		<form method="post">
			<div class="form-group">
				<label for="age">Age:</label>
				<input type="text" class="form-control" id="age" name="age" value="<?php echo $age; ?>">
			</div>

			<div class="form-group">
				<label for="steroid">Steroid:</label>
				<div class="form-check">
					<input type="radio" class="form-check-input" id="steroid1" name="steroid" value="1" <?php if($steroid==1) echo "checked"; ?>>
					<label class="form-check-label" for="steroid1">Yes</label>
				</div>
				<div class="form-check">
					<input type="radio" class="form-check-input" id="steroid0" name="steroid" value="0" <?php if($steroid==0) echo "checked"; ?>>
					<label class="form-check-label" for="steroid0">No</label>
				</div>
			</div>

			<div class="form-group">
				<label for="anorexia">Anorexia:</label>
				<div class="form-check">
					<input type="radio" class="form-check-input" id="anorexia1" name="anorexia" value="1" <?php if($anorexia==1) echo "checked"; ?>>
					<label class="form-check-label" for="anorexia1">Yes</label>
				</div>
				<div class="form-check">
					<input type="radio" class="form-check-input" id="anorexia0" name="anorexia" value="0" <?php if($anorexia==0) echo "checked"; ?>>
					<label class="form-check-label" for="anorexia0">No</label>
				</div>
			</div>

			<div class="form-group">
				<label for="alive">Alive:</label>
				<input type="text" class="form-control" id="alive" name="alive" value="<?php echo $alive; ?>">
			</div>

			<button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
			<a href="dataset.php" class="btn btn-secondary">Kembali</a>
		</form>
	</div>
</body>
</html>
