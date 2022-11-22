<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
  <a href="Companyhm.php">Home</a>

  <div class="dropdown">
    <button class="dropbtn">Manage Items 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="uploaditems.php">Upload Items</a>
      <a href="viewitemsblock.php">Block Form</a>
      <a href="viewitemstable.php">Table Form</a>
      <a href="#">Search</a>
    </div>
  </div>

  <div class="dropdown">
    <button class="dropbtn">History 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="purchasehistorycom.php">Purchase History</a>
      <a href="#">Search</a>
    </div>
  </div> 
  <a href="compinfo.php">Profile</a>
  <a href="logout.php">Logout</a>

</div>
</body>
</html>