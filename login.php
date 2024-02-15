<?php

session_start();
include 'connection.php';

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<div class="center">
        <h1>Login</h1>
        <form action="login.php" method="POST">
           
            <label for="email">Email Address: </label>
            <input type="email" name="email" required/><br>

            <label for="password">Passwordd: </label>
            <input type="password" name="password" required/><br>

            <input type="submit" name="login" value="login"><br><br>
            <a href="register.php">Register here</a> <!-- Fixed closing tag -->
        </form>
    </div>

    <?php
//session_start(); // Start session

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Fix SQL query syntax error by removing extra double quote at the end
    $select = mysqli_query($conn, "SELECT * FROM tbl_users WHERE email_address = '$email' AND password = '$password'");
    $row = mysqli_fetch_array($select);
    $status = $row['status'];
    

    $select2 = mysqli_query($conn, "SELECT * FROM tbl_users WHERE email_address = '$email' AND password = '$password'");

    // Reuse the same query to check for the number of rows
    $check_user = mysqli_num_rows($select2);
    
    if($check_user == 1){
        $_SESSION["status"] = $row['status'];
        $_SESSION["email"] = $row['email_address'];
        $_SESSION["password"] = $row['password'];
        
        if($status == "approved"){
            echo '<script type="text/javascript">';
            echo 'alert("Login Success!");';
            echo 'window.location.href = "user-dashboard.php";'; // Corrected syntax--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
            echo '</script>';
        }
        elseif ($status == "pending"){
            echo '<script type="text/javascript">';
            echo 'alert("Your account is still pending for approval!");';
            echo 'window.location.href = "login.php";'; // Corrected syntax
            echo '</script>';
        }
        // Remove unnecessary else block
    }
    else {
        echo "Incorrect email or password!"; // Output error message
    }
}
?>

</body>
</html>