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

if($_SERVER["REQUEST_METHOD"] == "POST"){

     $nick_name=$_POST['nick_name'];
     $address=$_POST['address'];
    
    $sql="UPDATE users set nick_name=?, address=? WHERE uid=?";
    echo $sql;
    $stmt=$mysqli->prepare($sql);
    $stmt->bind_param("ssi",  $nick_name,  $address, $_COOKIE['usercookie']);
    if($stmt->execute()){
        setcookie('usercookie','',time()-50000);
        header("location:Individualhm.php");
    }

    $message = "Record Modified Successfully";
    }
    
$result = mysqli_query($mysqli,"SELECT * FROM users WHERE uid=".$_GET['userid']."");
$row= mysqli_fetch_array($result);
setcookie('usercookie',$_GET['userid'],time()+50000);
?>

<html>
<head>
    <title>Update items</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include('comnav.php'); ?>
    <div class="container container-card" data-aos="zoom-in" data-aos-duration="1500">
    <div class="card">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <div><?php if(isset($message)) { echo $message; } ?></div>
        <div style="padding-bottom:5px;"></div>
    ID: <br>
        <input disabled="true" type="text" name="id"  value="<?php echo $row['uid']; ?>">
        <br><br>
    User Name: <br>
        <input disabled="true" type="text" name= "name" value="<?php echo $row['username']; ?>">
        <br><br>
    Nick Name:<br>
        <input type="text" name="nick_name" value="<?php echo $row['nick_name']; ?>">
        <br><br>
    Address:<br>
        <input type="text" name="address" value="<?php echo $row['address']; ?>">
        <br><br>
        <button class="btn"><input type="submit" name="submit" value="Submit" class="but"></button>
        

</form>
</div>
</div>
</body>
</html>