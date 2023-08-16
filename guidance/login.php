



<?php

$firstname= $_POST['firstname'];
$lastname=$_POST['lastname'];
$email  = $_POST['email'];
$password = $_POST['password'];
$Cpassword = $_POST['Cpassword'];


if(strcmp($password, $Cpassword)==0)
{
if (!empty($firstname) ||!empty($lastname) ||!empty($email) || !empty($password) || !empty($Cpassword) )
{
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "career";



// Create connection
$conn = new mysqli ($host, $dbfirstname,$dblastname,$dbemail, $dbpassword,$dbCpassword,$dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $USER ="SELECT email FROM login Where email= ? LIMIT 1";
  $PASS="INSERT INTO login(email,password)values(?,?)";
  
  $SELECT = "SELECT email From signup Where email = ? Limit 1";
  $INSERT = "INSERT Into signup (firstname,lastname, email ,password, Cpassword)values(?,?,?,?)";

//Prepare statement
     $log = $conn->prepare($USER);
     $log->bind_param("s",$email);
     $log->execute();$log->store_result();

     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
$log = $conn->prepare($PASS);
      $log->bind_param("ss", $email,$password);
      $log->execute();






      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sssss", $firstname,$lastname, $email,$password,$Cpassword);
      $stmt->execute();
      echo "New record inserted sucessfully";
      header("location:login.html"); 
     } 
     else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
}
else{
  echo "Passwords dosen't match";
}
?>
<?php
$email= $_POST['email'];
$password = $_POST['password'];
if (!empty($email)  || !empty($password)  )
{
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "career";
$conn = new mysqli ($host, $dbemail, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}else{
	$SELECT ="SELECT password FROM login Where email = '$email' " ;
	$stmt = $conn->prepare($SELECT);
	$stmt->execute();
	$stmt_result = $stmt->get_result();
	$data=$stmt_result->fetch_assoc();}

	if($data['password'] == $password)
	{
		header("location:login.html");
	}else{
		echo "your password is wrong";
	}
}
?>