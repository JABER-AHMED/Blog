<?php include '../lib/session.php'; 

session::checkLogin();

?>
<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>
<?php include '../helpers/Format.php'; ?>

<?php 

$db = new Database();
$format = new Format();

?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Password Recovery</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
	<?php 

	if(isset($_POST['submit'])){

		$email = $format->validation($_POST['email']);
		$email = mysqli_real_escape_string($db->link,$email);

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			echo "Invalid Email Adress";
		}
		else{
		$mailquery = "SELECT * FROM table_user WHERE email = '$email' LIMIT 1";
		$mailcheck = $db->select($mailquery);

		if($mailcheck == true){
			while ($value = $mailcheck->fetch_assoc()) {
				$userid   = $value['id'];
				$username = $value['username'];
			}
			$text     = substr($email, 0, 3);
			$rand     = rand(10000, 99999);
			$newpass  = "$text$rand";
			$password = md5($newpass);

			$updatequery = "UPDATE table_user
		                    SET
		                    userpassword = '$password'
		                    WHERE id = '$userid'";
            $updated_row = $db->update($updatequery);

            $to       = "$email";
            $from     = "placidcse@gmail.com";
            $headers  = "From: $from\n";
            $headers .= 'MIME-Version: 1.0' ."\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $subject  = "Your Password";
            $message  = "Your Username is ".$username." and Passwor is ".$newpass." Please visit website to login.";

            $sendmail = mail($to, $subject, $message, $headers);
            if ($sendmail) {
            	echo "<span style = 'color:green; font-size: 18px;'>Please Check Your Email !!.</span>";
            }else{
            	echo "<span style = 'color:red; font-size: 18px;'>Email Not Sent !!.</span>";
            }

			}else{

			echo "<span style = 'color:red; font-size: 18px;'>Email Not Exists !!.</span>";
		}
	}
}

	?>
		<form action="" method="post">
			<h1>Password Recovery</h1>
			<div>
				<input type="text" placeholder="Enter Valid Email..." required="" name="email"/>
			</div>
			<div>
				<input type="submit" value="Send Mail" name="submit" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="login.php">Login</a>
		</div><!-- button -->
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>