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
    <div class="container" >
    <h1>Your Items in Table Form:</h1>


<?php
        if($resultitem -> num_rows >0){
        ?>
        
        <table class="job" data-aos="fade-up" data-aos-duration="1500">
            <tr>
                <th>Photo</th>
                <th>Name</th>
                <th>Discription</th>
                <th>Price</th>
                <th>Update/View</th>
                <th>Delete</th>
                <th>Item Purchase Record:</th>
                
            </tr>
            <?php 
            $countrow = 0;
                while($rowitems = $resultitem-> fetch_assoc()){
                    ?>
                <tr>
                <td><img class="profile" src=<?php echo $filename.$rowitems["photo_img"]; ?> alt="" width="100" height="100"></td>
                <td> <?php echo $rowitems["name"];?></td>
                <td><?php echo $rowitems["discription"];?></td>
                <td>$<?php echo $rowitems["price"];?></td>
                <td><button class="btn"><a href="updateitem.php?itemid=<?php echo $rowitems["itemid"]; ?>">Update</a></button></td>
                <td><button class="btn"><a href="deleteitems.php?itemid=<?php echo $rowitems["itemid"]; ?>">Delete</a></button></td>
                <td><button class="btn"><a href="itempurchase.php?itemid=<?php echo $rowitems["itemid"]; ?>">History</a></button></td>
                </tr>
            <?php
            $countrow++;
            }
            ?>


        </table>

        

        <?php
        }
        else
        {
        echo "No result";
        }
        ?>
        </div>
</body>
</html>