﻿<?php
// Include config file
include('dbconnect.php'); 

if($mysqli === false){
    die("ERROR: Could not connect. " 
        . mysqli_connect_error());
}
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = $nickname = $email = $account_type = $fileext = $target_dir = $target_file= $filename = "";
$username_err = $password_err = $confirm_password_err = $nickname_err = $email_err = $account_type_err = $img_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $fileext = pathinfo($_FILES["profile_img"]["name"], PATHINFO_EXTENSION);
    $target_dir = "profile/";
    $target_file = $target_dir.$_POST["username"].".".$fileext;
    
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT uid, username FROM users WHERE username = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        $stmt->close();
    }
    
    // Validate nickname
    if(empty(trim($_POST['nickname']))){
        $nickname_err = "Please enter a Nick Name.";     
    } else{
        $nickname = trim($_POST['nickname']);
    }

    /*// Validate password strength

    // Validate password
    if(empty(trim($_POST['password']))){
        $password_err = "Please enter a password.";     
    }elseif(strlen(trim($_POST['password'])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    }elseif(!preg_match('@[A-Z]@', $_POST['password'])) {
        $password_err = "Password should be at least one upper case letter";
    }elseif(!preg_match('@[a-z]@', $_POST['password'])) {
        $password_err = "Password should be at least one lower case letter.";
    }elseif(!preg_match('@[0-9]@', $_POST['password'])) {
        $password_err = "Password should be at least one number.";
    }elseif(!preg_match('@[^\w]@', $_POST['password'])) {
        $password_err = "Password should be at least one special character.";
    }else{
        $password_err = "Strong password.";
        $password = trim($_POST['password']);
    }*/
    
    // Validate password strength
    $uppercase = preg_match('@[A-Z]@', $_POST['password']);
    $lowercase = preg_match('@[a-z]@', $_POST['password']);
    $number    = preg_match('@[0-9]@', $_POST['password']);
    $specialChars = preg_match('@[^\w]@', $_POST['password']);
    // Validate password
    if(empty(trim($_POST['password']))){
        $password_err = "Please enter a password.";     
    } elseif(!$uppercase || !$lowercase || !$number || !$specialChars || strlen(trim($_POST['password'])) < 6){
        $password_err = "Password should be at least 6 characters in length and should include at least one upper case letter, one number, and one special character.";
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = 'Please confirm password.';     
    } else{
        $confirm_password = trim($_POST['confirm_password']);
        if($password != $confirm_password){
            $confirm_password_err = 'Password did not match.';
        }
    }

    if(empty(trim($_POST['email']))){
        $email_err = "Please enter a email.";     
    } else if(!filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)){
        $email_err = "Invalid email format!";
        $email = trim($_POST['email']);
    } else{
        $email = trim($_POST['email']);
    }

    if(empty(trim($_POST['account_type']))){
        $account_type_err = "Please enter a Account Type.";     
    } else if(trim($_POST['account_type']) == 'Company'){
        $account_type = trim($_POST['account_type']);
    } else if(trim($_POST['account_type']) == 'Individual'){
        $account_type = trim($_POST['account_type']);
    }else{
        $account_type_err = "Invalid Type!";
        $account_type = trim($_POST['account_type']);
    }

    $address = trim($_POST['address']);






    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err && empty($nickname_err) && empty($email_err) && empty($account_type_err))){
        //upload the file.
        
        if ($_FILES['profile_img']['size'] == 0){
            $sql = "INSERT INTO users (username, password, nick_name, email, type) VALUES (?, ?, ?, ?, ?)";
            if($stmt = $mysqli->prepare($sql)){
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_nickname = $nickname;
            $param_email = $email;
            $param_account_type = $account_type;

            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sssss", $username, $param_password, $nickname, $email, $account_type);
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if (move_uploaded_file($_FILES["profile_img"]["tmp_name"], $target_file)) {
                    $img_err = "The file ". htmlspecialchars( basename( $_FILES["profile_img"]["name"])). " has been uploaded.";
                  } else {
                    $img_err =  "Sorry, there was an error uploading your file.";
                  }
                // Redirect to login page
                echo $filename;
                header("location: index.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        }
        else{
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, nick_name, email, type, profile_img, address) VALUES (?, ?, ?, ?, ?, ?, ?)";
        if($stmt = $mysqli->prepare($sql)){
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_nickname = $nickname;
            $param_email = $email;
            $param_account_type = $account_type;
            $filename = $_POST["username"].".".$fileext;
            $address = $address;

            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssssss", $username, $param_password, $nickname, $email, $account_type, $filename, $address);
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if (move_uploaded_file($_FILES["profile_img"]["tmp_name"], $target_file)) {
                    $img_err = "The file ". htmlspecialchars( basename( $_FILES["profile_img"]["name"])). " has been uploaded.";
                  } else {
                    $img_err =  "Sorry, there was an error uploading your file.";
                  }
                // Redirect to login page
                header("location: index.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        }
         
        // Close statement
        $stmt->close();
    }
    
    // Close connection
    $mysqli->close();
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<!-- Top menu -->
<div class="overlay3"></div><div class="overlay2 overlay22" ></div>
<div class="container">
<div class="login2 login22">  
    <div class="center">       
        <h1>Sign Up</h1>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">

            
            <div>
                <p>Profile image:<input type="file" accept="image/*" name="profile_img"></p>
                <span class="err"><?php echo $img_err; ?></span>
            </div>

            <div>
                <label>Username</label>
                <p><input type="text" name="username" ></p>
                <span class="err"><?php echo $username_err; ?></span>
            </div>    

            <div>
                <label>Nick name</label>
                <p><input type="text" name="nickname"></p>
                <span class="err"><?php echo $nickname_err; ?></span>
            </div>

            <div>
                <label>Password</label>
                <p><input type="password" name="password"></p>
                <span class="err"><?php echo $password_err; ?></span>
            </div>
            <div>
                <label>Confirm Password</label>
                <p><input type="password" name="confirm_password"></p>
                <span class="err"><?php echo $confirm_password_err; ?></span>
            </div>

            <div>
                <label>Email</label>
                <p><input type="text" name="email"></p>
                <span class="err"><?php echo $email_err; ?></span>
            </div>

            <div>
                <label>Account Type</label>
                <br>
                <select id="account_type" name="account_type">
                    <option value="Company">Company</option>
                    <option value="Individual">Individual</option>
                </select>
                <span class="err"><?php echo $account_type_err; ?></span>
            </div>
            <br>
            <div>
                <label>Address</label><br>
                <textarea rows = "5" cols = "45" name = "address">Enter details here...
                </textarea>
            </div>
            <br>
            <div>
                <button class="btn"><input type="submit" value="Submit"></button>
                <button class="btn"><input type="reset" value="Reset"></button>     
            </div>
            <p>Already have an account? <a href="index.php">Login here</a>.</p>
        </form>
    </div> 
</div> 
</div>
</body>
</html>