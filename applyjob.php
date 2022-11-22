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
$id=$_GET['jobid'];
$user=$_COOKIE['user'];


$sql="SELECT * FROM apply where jobid=$id AND uid= '$user'";
$result = $mysqli->query($sql);
if($result->num_rows > 0){
    header("location:applyalready.html");
} 

else{
    mysqli_query($mysqli,"INSERT INTO apply(jobid,uid) value($id,'$user')");
    header("location:Individual.php");
}

?>