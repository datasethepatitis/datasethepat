<!DOCTYPE html>
<html lang="en">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
}

body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: #ffa12c;
}

.container {
    width: 100%;
    display: flex;
    max-width: 850px;
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
}

.login {
    width: 400px;
}

form {
    width: 250px;
    margin: 60px auto;
}

h3 {
    margin: 20px;
    text-align: center;
    font-weight: bolder;
    text-transform: uppercase;
}

hr {
    border-top: 2px solid #ffa12c;
}

p {
    text-align: center;
    margin: 10px;
}

.right img {
    width: 450px;
    height: 100%;
    border-top-right-radius: 15px;
    border-bottom-right-radius: 15px;
}

form label {
    display: block;
    font-size: 16px;
    font-weight: 600;
    padding: 5px;
}

input {
    width: 100%;
    margin: 2px;
    border: none;
    outline: none;
    padding: 8px;
    border-radius: 5px;
    border: 1px solid gray;
}

button {
    border: none;
    outline: none;
    padding: 8px;
    width: 252px;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
    margin-top: 20px;
    border-radius: 5px;
    background: #ffa12c;
}

button:hover {
    background: rgba(214, 86, 64, 1);
}


@media (max-width: 880px) {
    .container {
        width: 100%;
        max-width: 750px;
        margin-left: 20px;
        margin-right: 20px;
    }

    form {
        width: 300px;
        margin: 20px auto;
    }

    .login {
        width: 400px;
        padding: 20px;
    }

    button {
        width: 100%;
    }

    .right img {
        width: 100%;
        height: 100%;
    }
}

</style>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Naive Bayes</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <div class="login">
            <form action="classifier.php" method="POST" name="myForm" onsubmit="return validateForm()">
                <h3>NAIVE BAYES HEPATITIS</h3>
                <hr>
                <p>DI ISI DULU YA ADIK ADIK</p>
                <label for="age">Age</label>
                <input type="text" name="age" id="age" placeholder="Masukan Umur">
                <label for="steroid">Steroid</label>
                <select name="steroid" id="steroid">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
                <label for="anorexia">Anorexia:</label>
                <select name="anorexia" id="anorexia">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
                <input type="submit" name="submit" class="btn btn-warning" value="Submit">
                <a href="dataset.php">KEMBALI KE DATASET</a>
            </form>
        </div>
        <div class="right">
            <img src="img/hepatitis.png" alt="">
        </div>
    </div>
</body>
<script>
    function validateForm() {
        var age = document.forms["myForm"]["age"].value;
        var steroid = document.forms["myForm"]["steroid"].value;
        var anorexia = document.forms["myForm"]["anorexia"].value;
        if (age == "" || steroid == "" || anorexia == "") {
            alert("Data diisi terlebih dahulu");
            return false;
        }
    }
</script>
</html>