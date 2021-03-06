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
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
	<?php 

	if(isset($_POST['submit'])){

		$username = $format->validation($_POST['username']);
		$password = $format->validation(md5($_POST['password']));

		$username = mysqli_real_escape_string($db->link,$username);
		$password = mysqli_real_escape_string($db->link,$password);

		$query = "SELECT * FROM table_user WHERE username = '$username' AND userpassword = '$password'";
		$result = $db->select($query);

		if($result != false){
			/*$value = mysqli_fetch_array($result);*/
			$value = $result->fetch_assoc();
				
				session::set("login", true);
				session::set("username", $value['username']);
				session::set("userid", $value['id']);
				session::set("userRole", $value['role']);
				header("Location:index.php");
			}else{

			echo "<span style = 'color:red; font-size: 18px;'>Username or Password not matched !!.</span>";
		}
	}

	?>
		<form action="login.php" method="post">
			<h1>Admin Login</h1>
			<div>
				<input type="text" placeholder="Username" required="" name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="password"/>
			</div>
			<div>
				<input type="submit" value="Log in" name="submit" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="forgetpass.php">Forgot Password !</a>
		</div><!-- button -->
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>