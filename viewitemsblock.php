<?php
// Initialize the session
include('dbconnect.php'); 
///////////////////////////////////////////////////////////////////////////////////////////
$result="";
$filename = "";
if($_COOKIE["loggedin"] != "true"){
    // Redirect user to welcome page
    header("location:index.php");
}else{
    ;
}
////////////////////////////////////////////////////////////////////////////////////////
//show database data
$filename= "items/";
$username = $_COOKIE["user"];
$sql = "SELECT * FROM users WHERE username = '$username'";
$resultusers = mysqli_query($mysqli,$sql);
$rowusers = mysqli_fetch_array($resultusers);

$sql = "SELECT * FROM items WHERE company = '$username'";
$resultitem = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $username ?> | Table Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include('comnav.php'); ?>
    <div class="container">
    <h1>Your Items in Table Form:</h1>

    <div class="grid">
<?php
        if($resultitem -> num_rows >0){
            $countrow = 0;
                while($rowitems = $resultitem-> fetch_assoc()){
                ?> 
                <div class="card" data-aos="flip-up" data-aos-duration="1000">
                
                Photo: <br>
                
                <img class="profile" src=<?php echo $filename.$rowitems["photo_img"]; ?> alt="" width="100" height="100"><br>
                <div class="item-col">
                    <div class="item-left">Name:</div><div class="item-right" > <?php echo $rowitems["name"];?></div>
                </div>
                <div class="item-col">
                    <div class="item-left">Discription:</div><div class="item-right" > <?php echo $rowitems["discription"];?></div>
                </div>
                <div class="item-col">
                    <div class="item-left">Price:</div><div class="item-right" > <?php echo $rowitems["price"];?></div>
                </div>
                <div class="item-col">
                    <div class="item-left">Update/View:</div><div class="item-right" > <a href="updateitem.php?itemid=<?php echo $rowitems["itemid"]; ?>">Update</a></div>
                </div>
                <div class="item-col">
                    <div class="item-left">Delete:</div><div class="item-right" ><a href="deleteitems.php?itemid=<?php echo $rowitems["itemid"]; ?>">Delete</a></div>
                </div>
                <div class="item-col">
                    <div class="item-left">Item Purchase Record:</div><div class="item-right" > <a href="itempurchase.php?itemid=<?php echo $rowitems["itemid"]; ?>">History</a></div>
                </div>


               
                </div>

            <?php
            $countrow++;
            }
        }
        else
        {
        echo "No result";
        }
        ?>
    </div>

    </div>
</body>
</html>