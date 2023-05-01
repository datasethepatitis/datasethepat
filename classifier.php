<?php

session_start();
$db = mysqli_connect("localhost", "root", "", "bayes_data");

if (isset($_POST['submit'])) {
    // Mengambil nilai-nilai input dari form
    $age_inp = $_POST['age'];
    $steroid_inp = $_POST['steroid'];
    $anorexia_inp = $_POST['anorexia'];
    $ageasli = $age_inp;
    $steroidasli = $steroid_inp;
    $anorexiaasli = $anorexia_inp;
    
    $query = "SELECT * FROM dataset";
    $result = mysqli_query($db, $query);
    
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
        $age = $row['age'];
        $steroid = $row['steroid'];
        $anorexia = $row['anorexia'];
        $alive = $row['alive'];
        
        // Validasi input alive
        if ($alive != 0 && $alive != 1) {
            echo "Input alive tidak valid";
            exit;
        }
    }

$kombinasi = array();
$io = array();
$output = array();
$alive = array();
$age = "";
$steroid = "";
$anorexia = "";
foreach ($data as $row) {
    if ($row['age'] >= 35) {
        $age = 1;
    } else {
        $age = 0;
    }
    if ($row['steroid'] == 1) {
        $steroid = 1;
    } else {
        $steroid = 0;
    }
    if ($row['anorexia'] == 1) {
        $anorexia = 1;
    } else {
        $anorexia = 0;
    }
    $kombinasi[] = $age.$steroid.$anorexia.$row['alive'];
    $io[] = $age.$steroid.$anorexia;
    $alive[] = $row['alive'];
}


$alive0 =  count(array_keys($alive, 0));
$alive1 =  count(array_keys($alive, 1));
$all = count($data);
$counts = array_count_values($io);
$values = array(
    'nilai_111' => $counts['111'] ?? 0,
    'nilai_110' => $counts['110'] ?? 0,
    'nilai_101' => $counts['101'] ?? 0,
    'nilai_100' => $counts['100'] ?? 0,
    'nilai_011' => $counts['011'] ?? 0,
    'nilai_010' => $counts['010'] ?? 0,
    'nilai_001' => $counts['001'] ?? 0,
    'nilai_000' => $counts['000'] ?? 0,
);

$cwitho = array_count_values($kombinasi);

$input_bayes = array();
if ($age_inp >= 35) {
    $age_val = 1;
} else {
    $age_val = 0;
}
if ($steroid_inp == 1) {
    $steroid_val = 1;
} else {
    $steroid_val = 0;
}
if ($anorexia_inp == 1) {
    $anorexia_val = 1;
} else {
    $anorexia_val = 0;
}

//penginputan nilai bayes
//penginputan nilai bayes
//penginputan nilai bayes
//penginputan nilai bayes
//penginputan nilai bayes

$input_bayes[] = $age_val.$steroid_val.$anorexia_val;
//penginputan bayes 1 atau 0
//penginputan bayes 1 atau 0
//penginputan bayes 1 atau 0
$temp_0 = $cwitho[$input_bayes[0]."0"] ?? 0;
$temp_1 = $cwitho[$input_bayes[0]."1"] ?? 0;
// echo "sum000 : ".$values["nilai_000"]."<br>";
// echo "sum001 : ".$values["nilai_001"]."<br>";
// echo "sum010 : ".$values["nilai_010"]."<br>";
// echo "sum011 : ".$values["nilai_011"]."<br>";
// echo "sum100 : ".$values["nilai_100"]."<br>";
// echo "sum101 : ".$values["nilai_101"]."<br>";
// echo "sum110 : ".$values["nilai_110"]."<br>";
// echo "sum111 : ".$values["nilai_111"]."<br>";
// echo "Banyak orang yang mati : ".$alive0."<br>";
// echo "Banyak orang yang hidup : ".$alive1."<br>";
// echo "Total dataset : ".$all."<br>";
$peluang_A = "";
$prob_0 = "";
$prob_1 = "";

if ($prob_0 == 0 && $prob_1 == 0) {
    // jika probabilitas 0, maka naive bayes = 0
    $naive_bayes = 0; 
} else {
    // menghitung probabilitas prior
    $peluang_A = $values['nilai_'.$input_bayes[0]]/$all;
    // menghitung probabilitas posterior
    // rumus P(h | D) = P(D | h) * P(h) / P(D)
    $prob_0 = $temp_0/$alive0;
    $prob_1 = $temp_1/$alive1;
    $kali = $peluang_A * $prob_1;
    $bagi = $peluang_A * $prob_0;
    $naive_bayes = $kali / ($kali + $bagi);
}
//hasil naive bayes
$hasil = $naive_bayes > 0.5;

// menyimpan data ke dalam tabel di database
$sql = "INSERT INTO dataset VALUES (null, '$ageasli', '$steroidasli', '$anorexiaasli', '$hasil')";
if (mysqli_query($db, $sql)) {
    // echo "Data berhasil disimpan";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($db);
}
// echo ($naive_bayes*100)."%";

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <style>
		body {
			margin: 0 auto;
			text-align: center;
		}
    table{
      margin: 0 auto;
			text-align: center;
    }
	</style>
  <title>Document</title>
  <style>
    body{
      background-color: #ffa12c;
    }
    table{
  background-color: #f2f2f2;
  width: 30%;
  height: 0px;
  border-collapse: collapse;
  border-radius: 40px;
  }

  td {
  background-color: #fff;
  }

  th {
  background-color: #ccc;
  }
  </style>
</head>
<body>
  <div class="h2">
  <h2><u>Hasil Klasifikasi Naive Bayes</u></h2>
  </div>
  <div>
    <table>
    <tr><td>Usia</td><td>:</td><td><?php echo $age_inp ?></td></tr>
    <tr><td>Steroid</td><td>:</td><td><?php echo $steroid_inp ?></td></tr>
    <tr><td>Anorexia</td><td>:</td><td><?php echo $anorexia_inp ?></td></tr>
    <tr><td>SUM(1) TOTAL</td><td>:</td><td><?php echo $alive1 ?></td></tr>
    <tr><td>SUM(0) TOTAL</td><td>:</td><td><?php echo $alive0 ?></td></tr>
    <tr><td>sum000</td><td>:</td><td><?php echo $values["nilai_000"] ?></td></tr>
    <tr><td>sum001</td><td>:</td><td><?php echo $values["nilai_001"] ?></td></tr>
    <tr><td>sum010</td><td>:</td><td><?php echo $values["nilai_010"] ?></td></tr>
    <tr><td>sum011</td><td>:</td><td><?php echo $values["nilai_011"] ?></td></tr>
    <tr><td>sum100</td><td>:</td><td><?php echo $values["nilai_100"] ?></td></tr>
    <tr><td>sum101</td><td>:</td><td><?php echo $values["nilai_101"] ?></td></tr>
    <tr><td>sum110</td><td>:</td><td><?php echo $values["nilai_110"] ?></td></tr>
    <tr><td>sum111</td><td>:</td><td><?php echo $values["nilai_111"] ?></td></tr>
    <tr><td>Total Dataset</td><td>:</td><td><?php echo $all ?></td></tr>
    <tr><td>Pengali</td><td>:</td><td><?php echo $kali ?></td></tr>
    <tr><td>Pembagi</td><td>:</td><td><?php echo $bagi ?></td></tr>
    <tr><td>Naive Bayes</td><td>:</td><td><?php echo ($naive_bayes*100)."%" ?></td></tr>
    </table>
    <table>
    <?php
    if ($naive_bayes >= 0.5){
      echo '<span style="color:green"><h2>Pasien Hidup</h2></span>';
    } else{
      echo '<span style="color:red"><h2>Pasien Mati</h2></span>';
    }
    ?>   
    </table>
  </div>
  <a href="index.php" target="_blank">
  <button type="button" class="btn btn-danger">KEMBALI</button>
  </a>
</body>
</html>
