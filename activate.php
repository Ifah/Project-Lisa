<?php 
include("includes/connect.php");

if(isset($_GET['email']) && (filter_var($_GET['email'], FILTER_VALIDATE_EMAIL) ){
	$email = mysqli_real_escape_string($mysql_connect, $_GET['email']);

}

if(isset($_GET['key']) && (strlen($_GET['key'])==32) ){
	$key = mysqli_real_escape_string($mysql_connect, $_GET['key']);
}

if(isset($email) && isset($key)){
	$result = mysqli_query($mysql_connect, "SELECT * FROM tempusers WHERE (email='$email' AND activation='$key') LIMIT 1 ") or die(mysql_error());
	while($row = mysqli_fetch_array($result)){
		$user_id = mysqli_real_escape_string($mysql_connect, $row['user_id']);
		$username = mysqli_real_escape_string($mysql_connect, $row['username']);
		$email = mysqli_real_escape_string($mysql_connect, $row['email']);
		$password = mysqli_real_escape_string($mysql_connect, $row['password']);
	}

	$result1 = mysqli_query($mysql_connect, "INSERT INTO users (user_id,username,email,password,role,credits) VALUES ('','$username','$email','$password','user',0)") or die(mysql_error());
	$result2 = mysqli_query($mysql_connect, "DELETE FROM tempusers WHERE user_id='$user_id' ") or die(mysql_error());

	if(!$result1){
		echo "Oops your account could not be activated, please contact the system administrator!";
	}else{
		header( 'Location:prompt.php?x=0' );
	}
}else{
	echo "Error, please contact the system administrator!";
}

?>