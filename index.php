<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method = "post">
        <input name="email" type="text" placeholder="Email address">
        <input name="password" type="password" placeholder="Password">

        <input type="submit" value = "Sign up!">

    </form>

</body>
</html>

<?php

if(array_key_exists('email', $_POST) OR array_key_exists('password', $_POST)) {

    $conn = mysqli_connect(
        "sdb-56.hosting.stackcp.net",
        "yaslin",
        "kchbpyl29w",
        "yaslin-353031337075"
    );
    
    if(mysqli_connect_error()){
        die("There was an error connecting to the database.");
    }

    if($_POST['email'] == '') {
        echo "<p>Email address is required.<p>";
    }
    else if($_POST ['password'] ==  '') {
        echo "<p>Password is required</p>";
    }
    else {
        $query = "SELECT id FROM users WHERE email = '"
            .mysqli_real_escape_string($conn, $_POST ['email']) . "'";

        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($results) > 0){
            echo "<p>That email address has already been taken.</p>";
        }
        else {
            $query = "INSERT INTO users (email, password) VALUES ('"
            . mysqli_real_escape_string($conn, $_POST['email']) . "','"
            . mysqli_real_escape_string($conn, $_POST['password']) . "')";
        
        if(mysqli_query($conn, $query)) {
            echo "<p>You have signed up!</p>";
        }
        else {
            echo"<p>There was a problem signing you up! Please try again later.</p>";
        }
        }
    }
}


?>