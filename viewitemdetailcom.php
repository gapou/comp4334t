<?php
// Initialize the session
include('dbconnect.php'); 
///////////////////////////////////////////////////////////////////////////////////////////
$filename= "items/";
if($_COOKIE["loggedin"] != "true"){
    // Redirect user to page login
    header("location:index.php");
}else{
    ;
}
 
$result = mysqli_query($mysqli,"SELECT * FROM items WHERE itemid=".$_GET['itemid']."");
$row= mysqli_fetch_array($result);
?>

<html>
<head>
    <title>View Details</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container container-card item-table">
        
    

    
        <table>
        <tr>
                <th colspan="2">
                <img class="profile" src=<?php echo $filename.$row["photo_img"]; ?> alt="" width="100" height="100">
                </th>
    
            </tr>
    
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
                </td><br>
            </tr>
                
            <tr>
                <th colspan="2">
                <br>
                </th>
    
            </tr>
    
        </table>
    
        
        
        </div>
</body>
</html>