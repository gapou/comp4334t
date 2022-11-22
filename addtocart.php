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

$id=$_GET['itemid'];
$user=$_COOKIE['user'];

    $sql="INSERT INTO cart(uid,itemid) value(?,?)";
    $stmt2=$mysqli->prepare($sql);
    $stmt2->bind_param("ss",$user ,$id);
    $stmt2->execute();
    $stmt2->store_result();
    header("location:Individualhm.php");
    //mysqli_query($mysqli,"INSERT INTO apply(jobid,uid) value($id,$user)");
    

?>