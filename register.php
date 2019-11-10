<?php
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$area_pin= $_POST['area_pin'];
$mobile = $_POST['mobile'];

if (!empty($username) || !empty($password) || !empty($area_pin) || !empty($email) || !empty($mobile)) {
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "test";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     $SELECT = "SELECT email From sample Where email = ? Limit 1";
     $INSERT = "INSERT Into sample (username,mobile,email,password,area_pin) values(?, ?, ?, ?, ?)";
     //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sssii", $username, $password,  $email, $area_pin, $mobile);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}

?>