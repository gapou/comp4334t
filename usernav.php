<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
  <a href="Individualhm.php">Home</a>
  
  <div class="dropdown">
    <button class="dropbtn">Manage Items 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="viewitemsblockuser.php">Block Form</a>
      <a href="viewitemstableuser.php">Table Form</a>
      <a href="#">Search</a>
    </div>
  </div>


  <div class="dropdown">
    <button class="dropbtn">Profile
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="userinfo.php">Manage My account</a>
      <a href="purchasehistory.php">Purchase History</a>
    </div>
  </div> 
  <div class="shoppingcart">
    <a href="cart.php" >Shopping Cart</a>

  </div>
  <a href="logout.php">Logout</a>
</div>

</body>
</html>