<?php 
$con = mysqli_connect('localhost', 'root', '', 'social');
if(mysqli_connect_error()) {
    echo 'Failed to connect: ' . mysqli_connect_error();
}

$query = mysqli_query($con, "INSERT INTO test VALUES('', 'kai')");

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Social Network</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
</head>
<body>
    sdfsadf
</body>
</html>