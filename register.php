<?php
$con = mysqli_connect('localhost', 'root', '', 'social');
if(mysqli_connect_error()) {
    echo 'Failed to connect: ' . mysqli_connect_error();
}
$fname = '';
$lname = '';
$email = '';
$email2 = '';
$password = '';
$password2 = '';
$date = '';
$error_array = '';

if(isset($_POST['register_button'])) {
    $fname = strip_tags($_POST['reg_fname']); // remove html tags
    $fname = str_replace(' ', '', $fname); // remove spaces
    $fname = ucfirst(strtolower($fname));

    $lname = strip_tags($_POST['reg_lname']); // remove html tags
    $lname = str_replace(' ', '', $lname); // remove spaces
    $lname = ucfirst(strtolower($lname));

    $email = strip_tags($_POST['reg_email']); // remove html tags
    $email = str_replace(' ', '', $email); // remove spaces
    $email = ucfirst(strtolower($email));

    $email2 = strip_tags($_POST['reg_email2']); // remove html tags
    $email2 = str_replace(' ', '', $email2); // remove spaces
    $email2 = ucfirst(strtolower($email2));

    $password = strip_tags($_POST['reg_password']); // remove html tags
    

    $password2 = strip_tags($_POST['reg_password2']); // remove html tags

    $date = date("Y-m-d");
    
    if($email == $email2) {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);

            $e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$email");

            $num_rows = mysqli_num_rows($e_check);

            if($num_rows > 0) {
                echo "Email already in use";
            }
        } else {
            echo "Invalid Format";
        }
    } else {
        echo "Emails don't match";
    }

    if(strlen($fname) > 50 || strlen($fname < 2)) {
        echo "Name must be between 2 and 25 characters";
    }

    if(strlen($lname > 50) || strlen($lname < 2)) {
        echo "Name must be between 2 and 25 characters";
    }

    if($password != $password2) {
        echo "Passwords must match";
    } else {
        if(preg_match('/[^A-Za-z0-9]/', $password)) {
            echo "Your password can only contain numbers or characters"
        }
    }

    if(strlen($password) > 30 || strlen($password < 5)) {
        echo "Your password must be between 5 and 30 characters"
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Welcome to SwirlFeed</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
</head>
<body>
    <form action="register.php" method='POST'>
    <input autocomplete='off' type="text" name='reg_fname' placeholder='First Name' required>
    <br>
    <input autocomplete='off' type="text" name='reg_lname' placeholder='Last Name' required>
    <br>
    <input autocomplete='off' type="email" name='reg_email' placeholder='Email' required>
    <br>
    <input autocomplete='off' type="email" name='reg_email2' placeholder='Confirm Email' required>
    <br>
    <input autocomplete='off' type="password" name='reg_password' placeholder='Password' required>
    <br>
    <input autocomplete='off' type="password" name='reg_password2' placeholder='Confirm Password' required>
    <br>
    <input type="submit" name='register_button' value='Register'>
    </form>
</body>
</html>