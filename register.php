<?php 
session_start();
include("includes/connect.php");
include("includes/html_codes.php");

if(isset($_POST['submit'])){
	$error = array();

	//username
	if(empty($_POST['username'])){
		$error[] = 'Please enter a username. ';
	}else if( ctype_alnum($_POST['username']) ){
		$username = $_POST['username'];
	}else{
		$error[] = 'Username must consist of letters and numbers only. ';
	}

	//email
	if(empty($_POST['email'])){
		$error[] = 'Please enter your email. ';
	}else if( filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ){
		$email = mysqli_real_escape_string($mysql_connect, $_POST['email']);
	}else{
		$error[] = 'Your e-mail address is invalid. ';
	}

	//password
	if(empty($_POST['password'])){
		$error[] = 'Please enter a password. ';
	}else{
		$password = mysqli_real_escape_string($mysql_connect, $_POST['password']);
	}

	if(empty($error)){
		$result = mysqli_query($mysql_connect, "SELECT * FROM users WHERE email='$email' OR username='$username' ") or die(mysql_error());
		//$result1 = mysqli_query($mysql_connect, "SELECT * FROM tempusers WHERE email='$email' OR username='$username' ") or die(mysql_error());
		if(mysqli_num_rows($result)==0){
			$activation = md5(uniqid(rand(), true));
			$result2 = mysqli_query($mysql_connect, "INSERT INTO tempusers (user_id,username,email,password,activation) VALUES ('','$username','$email','$password','$activation') ") or die(mysql_error());
			if(!$result2){
				die('Could not insert into database: '.mysql_error());
			}else{
				$message = "To activate your account, please click on this link: \n\n";
				$message.= "http://localhost:8080/lisa".'/activate.php?email='.urlencode($email)."&key=$activation";
				mail($email, 'Registration Confirmation', $message);
				header('Location: prompt.php?x=1');
			}
		}else{
			header('Location: prompt.php?x=2');
		}
	}else{
		$error_message = '<span class="error">';
		foreach ($error as $key => $values) {
			$error_message.= "$values";
		}
		$error_message.= "</span><br/><br/>";
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register</title>
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/forms.css">
	<link rel="stylesheet" href="css/register.css">
</head>
<body>
	<div id="wrapper">
		<?php headerAndSearchCode(); ?>
		<aside id="left_side">
			<img src="images/registerbanner.png" />
		</aside>
		<section id="right_side">
			<form id="generalform" class="container" method="POST" action="">
				<h3>Register</h3>
				<?php echo @$error_message; ?>
				<div class="field">
					<label for="username">Username:</label>
					<input type="text" class="input" id="username" name="username" maxlength="20"/>
					<p class="hint">20 characters maximum (letters and numbers only)</p>
				</div>
				<div class="field">
					<label for="email">Email:</label>
					<input type="text" class="input" id="email" name="email" maxlength="80"/>
				</div>
				<div class="field">
					<label for="password">Password:</label>
					<input type="password" class="input" id="password" name="password" maxlength="20"/>
					<p class="hint">20 characters maximum</p>
				</div>
				<input type="submit" name="submit" id="submit" class="button" value="Submit"/>
			</form>
		</section>
		<?php footerCode(); ?>
	</div>
</body>
</html>