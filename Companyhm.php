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
    <title>PETS Company | <?php echo $rowusers["username"] ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include('comnav.php'); ?>
    <div class="container" >
    <h2> Welcome!<br><br> <?php echo "User Name/Company: " . $rowusers["username"] ?> </h2>
    <div class="item-col-ar">
    <button class="btn"><a href="uploaditems.php">Upload Items</a></button>
    <br>
    <button class="btn"><a href="purchasehistorycom.php">Purchase History</a></button>
    </div>
    <h3> Your Items:</h3>


    <?php
            if($resultitem -> num_rows >0){
            ?>
            <table data-aos="fade-up" data-aos-duration="1500">
                <tr>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Discription</th>
                    <th>Price</th>
                    <th>Update/View</th>
                    <th>Delete</th>
                    <th>Check</th>
                    
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
            </div>
            

            <?php
            }
            else
            {
            echo "No result";
            }
            ?>
</body>
</html>