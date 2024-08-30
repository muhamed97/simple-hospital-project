<?php

$localhost = "localhost";
$username = "root";
$pass = "";
$database = "Hospital";

$connection = mysqli_connect($localhost, $username, $pass, $database);
if (!$connection) {
    die("Connection error: " . mysqli_connect_error());
}

$name=$email=$date="";
$errors=array('email'=>'','name'=>'','date'=>'');


if (isset($_POST['send'])) {
    if (empty($_POST['name'])) {
        $errors['name'] = "Please enter your Username";
    } else {
        $name = htmlspecialchars($_POST['name']);
    }

    if (empty($_POST['date'])) {
        $errors['date'] = "Please enter date ";
    } else {
        $date = htmlspecialchars($_POST['date']);
    }

    if (empty($_POST['email'])) {
        $errors['email'] = "Please enter your Email";
    } else {
        $email = htmlspecialchars($_POST['email']);
        $emailquery = "SELECT COUNT(*) FROM patient WHERE email = '$email'";
        $emailResult = mysqli_query($connection, $emailquery);
        if (!$emailResult) {
            die("Error in database" . mysqli_error($connection));
        }
        $emailRow = mysqli_fetch_array($emailResult);
        if ($emailRow[0] > 0) {
            $errors['email'] = "email is already registered";
        }
    }

   
    if (!array_filter($errors)) {
        $sql = "INSERT INTO patient (email,name,date) VALUES ('$email', '$name', '$date')";
        $query = mysqli_query($connection, $sql);
        if (!$query) {
            die("Query error: " . mysqli_error($connection));
        } else {
            header("Location: admin.php");
            exit;
        }
    }
}





?>




<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مستشفى الشفاء</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>EG Hospital</h2>
    <form action="index.php" method="post">
        <div class="form-group">
            <label for="name">Name of patient : </label>
            <input type="text" id="name" name="name" value="<?php echo $name ?>" >
            <span>*<?php echo $errors['name']; ?></span>

        </div>
        <div class="form-group">
            <label for="email">Email: </label>
            <input type="email" id="email" name="email" value="<?php echo $email ?>" >
            <span>*<?php echo $errors['email']; ?></span>

        </div>
        <div class="form-group">
            <label for="date">Date: </label>
            <input type="date" id="date" name="date" value="<?php echo $date ?>" >
            <span>*<?php echo $errors['date']; ?></span>

        </div>
        <div class="form-group">
            <input type="submit" value="Book now ! " name="send">
        </div>
    </form>
</body>
</html>


