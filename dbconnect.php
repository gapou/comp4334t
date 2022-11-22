<?php

header("Content-Security-Policy: base-uri 'self'; default-src 'self' ; style-src 'self' 'nonce-456' https://unpkg.com/aos@2.3.1/dist/aos.css https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css; script-src 'self' https://unpkg.com/aos@2.3.1/dist/aos.js https://kit.fontawesome.com/4456aede9e.js; frame-src 'none'; form-action 'self';");


// Initialize the session
session_start();
ob_start();
 
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'pet');



/* Attempt to connect to MySQL database */
$mysqli = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
?>

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap-3.1.1.min.css" rel='stylesheet' type='text/css' />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- Custom Theme files -->
<link href="css/style.css" rel='stylesheet' type='text/css'>

<!-- CSS only -->

<!----font-Awesome----->
<script src="https://kit.fontawesome.com/4456aede9e.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
<!----AOS----->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>



<!DOCTYPE html>
<html lang="en">

<body>
<script nonce="456">
  AOS.init();
</script>

</body>
</html>