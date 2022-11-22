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

$username = $_COOKIE["user"];
$msg = $img_err = $itemsname = $discription = $price= $filename = $target_dir = $target_file="";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $discription ="";
/*
    $itemsname=$_POST["name"];
    $discription=$_POST["discription"];
    $price=$_POST["price"];
    $filename = $username.$itemname.".".$fileext;
*/


$sql = "INSERT INTO items (company , name, discription, photo_img, price) VALUES (?, ?, ?, ?, ?)";
if($stmt = $mysqli->prepare($sql)){
    // Set parameters
    $fileext = pathinfo($_FILES["photo_img"]["name"], PATHINFO_EXTENSION);
    $target_dir = "items/";
    $target_file = $target_dir.$username.$_POST["name"].".".$fileext;
    $itemsname=$_POST["name"];
    $discription=$_POST["discription"];
    $price=$_POST["price"];
    $filename = $username.$itemsname.".".$fileext;

    // Bind variables to the prepared statement as parameters
    $stmt->bind_param("sssss",$username, $itemsname, $discription, $filename, $price);
    // Attempt to execute the prepared statement
    if($stmt->execute()){
            if (move_uploaded_file($_FILES["photo_img"]["tmp_name"], $target_file)) {
                $msg = "Uploaded.";
                $img_err = "The file ". htmlspecialchars( basename( $_FILES["photo_img"]["name"])). " has been uploaded.";
              } else {
                $img_err =  "Sorry, there was an error uploading your file.";
              }
        } else{
            echo "Something went wrong. Please try again later.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $username ?> | Upload Items</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include('comnav.php'); ?>
<div class="container container-card" data-aos="zoom-in" data-aos-duration="1500">
<div class="card" >
    <h1>Upload New Items</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">


                <div>
                    <label>Items Name</label><br>
                    <input type="text" name="name">
                </div>    

                <div>
                    <label>Items discription(s)</label><br>
                    <textarea rows = "5" cols = "45" name = "discription">Enter details here...
                    </textarea>
                    </div>

                
                <div>
                    <label>Price(HKD)</label><br>
                    <input type="text" name="price" value="0">
                </div>

                <div>
                <label>Photo of items</label>
                <p><input type="file" accept="image/*" name="photo_img"></p>
                <span class="err"><?php echo $img_err; ?></span>
                </div>

                <br>

                <div>
                    <button class="btn"><input class="but" type="submit" value="Submit"></button>&nbsp;&nbsp;
                    <button class="btn"><input class="but" type="reset" value="Reset"></button>
                    
                    
                </div>
                <span class="err"><?php echo $msg; ?></span>
            </form>
            </div>
</div>
</body>
</html>