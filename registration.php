<?php
/*
Author: Javed Ur Rehman
Website: http://www.allphptricks.com/
*/
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<?php
	require('db.php');
    // If form submitted, insert values into the database.
    if (isset($_REQUEST['username'])){
		$username = stripslashes($_REQUEST['username']); // removes backslashes
		$username = mysqli_real_escape_string($con,$username); //escapes special characters in a string
		
		 //escapes special characters in a string
		$mobile = stripslashes($_REQUEST['mobile']);
		$mobile = mysqli_real_escape_string($con,$mobile);
		$email = stripslashes($_REQUEST['email']);
		$email = mysqli_real_escape_string($con,$email);
		$password = stripslashes($_REQUEST['password']);
		$password = mysqli_real_escape_string($con,$password);

		$trn_date = date("Y-m-d H:i:s");
        $query = "INSERT into `usersdata` (username, password, mobile, email, trn_date) VALUES ('$username', '".md5($password)."', '$mobile', '$email', '$trn_date')";
        $result = mysqli_query($con,$query);
        if($result){
            echo "<div class='form'><h3>You are registered successfully.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
        }else{
			            echo "<div class='form'><h3>You are  not registered successfully.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
		}
    }else{
?>
<div class="form">
<h1>Registration</h1>
<form name="registration" action="" method="post">

<input type="text" name="mobile" placeholder="Mobile Number" required />
<input type="text" name="username" placeholder="Full Name" required />
<input type="email" name="email" placeholder="Email" required />
<input type="password" name="password" placeholder="Password" required />
<input type="text" name="promocode" placeholder="PromoCode"/>
<input type="submit" name="submit" value="Register" />
</form>
<div class="checkbox col-lg-12">
    <input type="checkbox" class="i-checks" checked> Agree to t&c
</div>
<p>Already registered? <a href='login.php'>Login Here</a></p>
<br /><br />
</div>
<?php } ?>
</body>
</html>
