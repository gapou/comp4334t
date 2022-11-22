<?php
// Initialize the session
include('dbconnect.php'); 
///////////////////////////////////////////////////////////////////////////////////////////

if($_COOKIE["loggedin"] != "true"){
    // Redirect user to page login
    header("location:index.php");
}else{
    ;
}

$sql="DELETE FROM items WHERE itemid=?";
$stmt=$mysqli->prepare($sql);
$stmt->bind_param("i",$_GET['itemid']);
$stmt->execute();

$message = "Record Modified Successfully";
header("location:Companyhm.php");
?>