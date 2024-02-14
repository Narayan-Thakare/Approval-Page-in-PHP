
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<div class="center">
        <h1>Registration</h1>
        <form action="register.php" method="POST">
            <label for="username">Username: </label>
            <input type="text"  name="username" required/><br>
            <label for="email">Email Address: </label>
            <input type="email" name="email" required/><br>
            <label for="password">Passwordd: </label>
            <input type="password" name="password" required/><br>
            <input type="submit" name="register" value="Register"><br><br>
            <a href="login.php">Login here</a> <!-- Fixed closing tag -->
        </form>
    </div>

    <?php
include 'connection.php';

if(isset($_POST['register'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Check if email already exists
    $select = "SELECT * FROM tbl_users WHERE email_address = '$email'";
    $result = mysqli_query($conn, $select);
    
    if(mysqli_num_rows($result) > 0) {
        echo '<script type="text/javascript">';
        echo 'alert("Email Already Taken!")';
        echo 'window.location.href = "register.php"';
        echo '</script>';
    } else {
        // Insert new user into the database
        $register = "INSERT INTO tbl_users (username, email_address, password, status) VALUES ('$username', '$email', '$password', 'pending')";
        mysqli_query($conn, $register);
        
        echo '<script type="text/javascript">';
        echo 'alert ("your account is pending for aproval")';
        echo 'window.location.href = "register.php"';
        echo '</script>';
    }
}
?>


</body>
</html>