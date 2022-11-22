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

$sql = "SELECT * FROM items";
$resultitem = $mysqli->query($sql);


?>

<!DOCTYPE html>
<html>
<head>
    <title>User Site | <?php echo $rowusers["username"] ?></title>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <?php include('usernav.php'); ?>
 


    <div class="container">
    

    <div class="home-ov" data-aos="zoom-in" data-aos-duration="1500">
    <div class="home-info">
    
                              <h3>professional Pet E-Commerce Shop</h3>
                              <h1>We provid the best your need here!</h1>
                              <h2> Welcome! <?php echo $rowusers["username"] ?> </h2>

    </div>
    </div>
    
    <div class="home-ph">
    <h1> Avilible Items:</h1>
    </div>

    <?php
            if($resultitem -> num_rows >0){
            ?>
            <table data-aos="fade-up" data-aos-duration="1500" class="usertable">
                <tr>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Company</th>
                    <th>Discription</th>
                    <th>Price</th>
                    <th>View</th>
                    <th>Add to cart</th>
                </tr>
                <?php 
                $countrow = 0;
                    while($rowitems = $resultitem-> fetch_assoc()){
                        ?>
                    <tr>
                    <td><img class="profile" src=<?php echo $filename.$rowitems["photo_img"]; ?> alt="" width="100" height="100"></td>
                    <td> <?php echo $rowitems["name"];?></td>
                    <td> <?php echo $rowitems["company"];?></td>
                    <td><?php echo $rowitems["discription"];?></td>
                    <td>$<?php echo $rowitems["price"];?></td>
                    
                    
                    <td><button class="btn"><a href="viewitemdetail.php?itemid=<?php echo $rowitems["itemid"]; ?>">View</a></button></td>
                    <td><button class="btn"><a href="addtocart.php?itemid=<?php echo $rowitems["itemid"]; ?>">Add to cart</a></button></td>
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