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
$filename= "items/";
$username=$_COOKIE['user'];

$sqlcart = "SELECT * FROM cart INNER JOIN items ON cart.itemid=items.itemid WHERE uid = '$username' ";
$resultcart = $mysqli->query($sqlcart);

$sqlusers = "SELECT * FROM users WHERE username = '$username'";
$resultusers = mysqli_query($mysqli,$sqlusers);
$rowusers = mysqli_fetch_array($resultusers);

$sqlitem = "SELECT * FROM items ";
$resultitem = $mysqli->query($sqlitem);



if($_SERVER["REQUEST_METHOD"] == "POST"){
    $discription ="";
/*
    $itemsname=$_POST["name"];
    $discription=$_POST["discription"];
    $price=$_POST["price"];
    $filename = $username.$itemname.".".$fileext;
*/


$sql = "INSERT INTO purchase (user, itemid, quantity, payment_method, address) VALUES (?, ?, ?, ?, ?)";
if($stmt = $mysqli->prepare($sql)){
    // Set parameters
    $payment=$_POST["payment"];
    $quantity=$_POST["quantity"];
    $address=$_POST["address"];

    // Bind variables to the prepared statement as parameters
    $stmt->bind_param("sssss",$username, $_COOKIE['itemidcookie'], $quantity, $payment, $address);
    // Attempt to execute the prepared statement
    if($stmt->execute()){
            setcookie('itemidcookie','',time()-50000);
            header("location:cart.php");
        } else{
            echo "Something went wrong. Please try again later.";
        }
    }
}
$result = mysqli_query($mysqli,"SELECT * FROM items WHERE itemid=".$_GET['itemid']."");
$row= mysqli_fetch_array($result);
setcookie('itemidcookie',$_GET['itemid'],time()+50000);


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
            <h3> <?php echo "User Name: " . $rowusers["username"] ?> </h3> 
            <h3> Check-Out: </h3>

            <table>
        <tr>
            <th>
            Items ID:
            </th>
            <td>
            <?php echo $row['itemid']; ?>
            </td>
        </tr>

        <tr>
            <th>
            Name:
            </th>
            <td>
            <?php echo $row['name']; ?>
            </td>
        </tr>

        <tr>
            <th>
            Description:
            </th>
            <td>
            <?php echo $row['discription']; ?>
            </td>
        </tr>


        <tr>
            <th>
            Price(HKD):<br>
            </th>
            <td>
            <?php echo $row['price']; ?>
            </td>
        </tr>

        <tr>
            <th>
            Photo:
            </th>
            <td>
            <img class="profile" src=<?php echo $filename.$row["photo_img"]; ?> alt="" width="100" height="100">
            </td>
        </tr>

    </table>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">


            <label>Quantity:</label>
            <input type="number" name="quantity" 
             value="1"><br><br>

            <label>Choose your payment mehotd:</label><br>
            <input type="radio" name="payment" value="Visa/Master" checked="yes">
            <label for="creditcard">Visa/Master</label><br>
            <input type="radio" name="payment" value="Paypal" >
            <label for="paypal">Paypal</label><br>
            <input type="radio" name="payment" value="Alipay" >
            <label for="Alipay">Alipay</label><br>

            <div>
                <label>Address</label><br>
                <textarea rows = "5" cols = "45" name = "address"><?php echo $rowusers["address"] ?>
                </textarea>
            </div>


             <br><br>
        
            <input type="submit" value="Check Out">  
            
        </form>
        
    </div>
    
</div>

</body>
</html>