<?php
include('dbconnect.php'); 
///////////////////////////////////////////////////////////////////////////////////////////
$result="";
if($_COOKIE["loggedin"] != "true"){
    // Redirect user to page login
    header("location:index.php");
}else{
    ;
}

$username=$_COOKIE['user'];

$sqlcart = "SELECT * FROM cart INNER JOIN items ON cart.itemid=items.itemid WHERE uid = '$username' ";
$resultcart = $mysqli->query($sqlcart);

$sqlusers = "SELECT * FROM users WHERE username = '$username'";
$resultusers = mysqli_query($mysqli,$sqlusers);
$rowusers = mysqli_fetch_array($resultusers);

$sqlitem = "SELECT * FROM items ";
$resultjob = $mysqli->query($sqlitem);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Company User Site</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include('usernav.php'); ?>
    <div class="container">
    <div>
        <div>
            <h3> <?php echo "User Name: " . $rowusers["username"] ?> </h3> 
            <h3> Things that in your cart: </h3>
            <?php
            if($resultcart -> num_rows >0){
            ?>
            <table class="job">
                <tr>
                    <th>Item Name</th>
                    <th>Price</th>
                    <th>Item Details</th>
                    <th>Check Out</th>
                    
                </tr>
                <?php 
                $countrow = 0;
                    while($rowcart = $resultcart-> fetch_assoc()){
                        ?>
                    <tr>
                    <td> <?php echo $rowcart["name"];?></td>
                    <td> $<?php echo $rowcart["price"];?></td>
                    <td><a href="viewitemdetailcom.php?itemid=<?php echo $rowcart["itemid"]; ?>" target="iframe_view" >View Items</a></td>
                    <td><a href="checkout.php?itemid=<?php echo $rowcart["itemid"]; ?>" >Check Out</a></td>
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
        
        <div>
        <iframe name="iframe_view" src="" title="cartjob" class="iframe"></iframe>
        </div>
    
    </div></div>
    


</body>
</html>