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

     $itemsname=$_POST['name'];
     $discription=$_POST['discription'];
     $price=$_POST['price'];
    (int) $itemsid=$_COOKIE['itemsidcookie'];
    
    $sql="UPDATE items set name=?, discription=? ,price=? WHERE itemid=?";
    echo $sql;
    $stmt=$mysqli->prepare($sql);
    $stmt->bind_param("sssi",  $itemsname,  $discription, $price, $_COOKIE['itemidcookie']);
    if($stmt->execute()){
        setcookie('itemidcookie','',time()-50000);
        header("location:Companyhm.php");}

    $message = "Record Modified Successfully";
    }
    
$result = mysqli_query($mysqli,"SELECT * FROM items WHERE itemid=".$_GET['itemid']."");
$row= mysqli_fetch_array($result);
setcookie('itemidcookie',$_GET['itemid'],time()+50000);
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
     items ID: <br>
        <input disabled="true" type="text" name="id"  value="<?php echo $row['itemid']; ?>">
        <br>
     Name: <br>
        <input type="text" name= "name" value="<?php echo $row['name']; ?>">
        <br>
    Discription:<br>
        <textarea rows = "5" cols = "66" name= "discription"><?php echo $row['discription']; ?>
        </textarea>
        <br>
    Price(HKD):<br>
        <input type="text" name="price" value="<?php echo $row['price']; ?>">
        <br>
        <input type="submit" name="submit" value="Submit" class="but">

</form>
</div>
</div>
</body>
</html>