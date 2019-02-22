<?php
session_start();
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
$error_array = array();

if(isset($_POST['register_button'])) {
    $fname = strip_tags($_POST['reg_fname']); // remove html tags
    $fname = str_replace(' ', '', $fname); // remove spaces
    $fname = ucfirst(strtolower($fname));

    $_SESSION['reg_fname'] = $fname;

    $lname = strip_tags($_POST['reg_lname']); // remove html tags
    $lname = str_replace(' ', '', $lname); // remove spaces
    $lname = ucfirst(strtolower($lname));

    $_SESSION['reg_lname'] = $lname;

    $email = strip_tags($_POST['reg_email']); // remove html tags
    $email = str_replace(' ', '', $email); // remove spaces
    $email = ucfirst(strtolower($email));

    $_SESSION['reg_email'] = $email;

    $email2 = strip_tags($_POST['reg_email2']); // remove html tags
    $email2 = str_replace(' ', '', $email2); // remove spaces
    $email2 = ucfirst(strtolower($email2));

    $_SESSION['reg_email2'] = $email2;

    $password = strip_tags($_POST['reg_password']); // remove html tags
    

    $password2 = strip_tags($_POST['reg_password2']); // remove html tags

    $date = date("Y-m-d");
    
    if($email == $email2) {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);

            $e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$email");

            $num_rows = mysqli_num_rows($e_check);

            if($num_rows > 0) {
                array_push($error_array, "Email already in use<br>");
            }
        } else {
            array_push($error_array, "Invalid Format<br>");
        }
    } else {
        echo "Emails don't match<br>";
    }

    if(strlen($fname) > 50 || strlen($fname < 2)) {
        array_push($error_array, "Name must be between 2 and 25 characters<br>");
    }

    if(strlen($lname > 50) || strlen($lname < 2)) {
        array_push($error_array, "Name must be between 2 and 25 characters<br>");
    }

    if($password != $password2) {
        echo "Passwords must match<br>";
    } else {
        if(preg_match('/[^A-Za-z0-9]/', $password)) {
            array_push($error_array, "Your password can only contain numbers or characters<br>");
        }
    }

    if(strlen($password) > 30 || strlen($password < 5)) {
        array_push($error_array, "Your password must be between 5 and 30 characters<br>");
    }

    if(empty($error_array)) {
        $password = md5($password);

        $username = strtolower($fname . "_" . $lname);
        $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
        $i = 0;
        while(mysqli_num_rows($check_username_query)!= 0) {
            $i++;
            $username = $username . "_" . $i;
            $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
        }

        $rand = rand(1,6);

        if($rand == 1) {
            $profile_pic = "assets/images/profile_pics/default/head_red.png";
        } else if ($rand == 2) {
            $profile_pic = "assets/images/profile_pics/default/head_pumpkin.png";
        } else if ($rand == 3) {
            $profile_pic = "assets/images/profile_pics/default/head_pomegranate.png";
        } else if ($rand == 4) {
            $profile_pic = "assets/images/profile_pics/default/head_belize_hole.png";
        } else if ($rand == 5) {
            $profile_pic = "assets/images/profile_pics/default/head_amethyst.png";
        } else if ($rand == 6) {
            $profile_pic = "assets/images/profile_pics/default/head_alizarin.png";
        }
        
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
    <input autocomplete='off' type="text" name='reg_fname' placeholder='First Name' value="<?php if(isset($_SESSION['reg_fname'])) {
        echo $_SESSION['reg_fname'];
    }  ?>"
    required>
    <br>
    <?php 
    if(in_array("Name must be between 2 and 25 characters<br>", $error_array)) {
        echo "Name must be between 2 and 25 characters<br>";
    }
    ?>
    <input autocomplete='off' type="text" name='reg_lname' placeholder='Last Name' value="<?php if(isset($_SESSION['reg_lname'])) {
        echo $_SESSION['reg_lname'];
    }  ?>" required>
    <br>
    <?php 
    if(in_array("Name must be between 2 and 25 characters<br>", $error_array)) {
        echo "Name must be between 2 and 25 characters<br>";
    }
    ?>
    <input autocomplete='off' type="email" name='reg_email' placeholder='Email' value="<?php if(isset($_SESSION['reg_email'])) {
        echo $_SESSION['reg_email'];
    }  ?>" required>
    <br>
    <?php 
    if(in_array("Email already in use<br>", $error_array)) {
        echo "Email already in use<br>";
    }
    else if(in_array("Invalid Format<br>", $error_array)) {
        echo "Invalid Format<br>";
    }
    else if(in_array("Emails don't match<br>", $error_array)) {
        echo "Emails don't match<br>";
    }
    ?>
    <input autocomplete='off' type="email" name='reg_email2' placeholder='Confirm Email' value="<?php if(isset($_SESSION['reg_email2'])) {
        echo $_SESSION['reg_email2'];
    }  ?>" required>
    <br>
    <input autocomplete='off' type="password" name='reg_password' placeholder='Password' required>
    <br>
    <?php 
    if(in_array("Your password can only contain numbers or characters<br>", $error_array)) {
        echo "Your password can only contain numbers or characters<br>";
    }
    else if(in_array("Your password must be between 5 and 30 characters<br>", $error_array)) {
        echo "Your password must be between 5 and 30 characters<br>";
    }
    else if(in_array("Passwords must match<br>", $error_array)) {
        echo "Passwords must match<br>";
    }
    ?>
    <input autocomplete='off' type="password" name='reg_password2' placeholder='Confirm Password' required>
    <br>
    <input type="submit" name='register_button' value='Register'>
    </form>
</body>
</html>