<?php 
include('includes/header.php');
if(isset($_SESSION['username'])) {
    $userLoggedIn = $_SESSION['username'];
} else {
    header('Location: register.php');
}
?>
    sdfsadf
</body>
</html>