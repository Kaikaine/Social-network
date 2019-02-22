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