<?php 
session_start();
include 'Database.php';

if (isset($_SESSION['barker_logged_in']))
{
	$email = $_SESSION['barker_logged_in'];
	$firstname = getFirstname($email);
}

if (isset($_COOKIE['barker_logged_in']))
{
	$email = $_COOKIE['barker_logged_in'];
	$firstname = getFirstname($email);
}

function getFirstname($email)
{
	$database = new Database("darrentask");
	$result = $database->getUser($email);
	$result = mysqli_fetch_assoc($result);
	return $result['firstname'];
}

?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div id="formContainer">
	<?php if (isset($_COOKIE['barker_logged_in']) || isset($_SESSION['barker_logged_in']))
	{?>
		<h1>Welcome to the site, <?php echo $firstname?>!</h1>
		<h2>There's not too much to see here right now...</h2><br>
		<?php 
		if (isset($_COOKIE['barker_logged_in']))
		{
			echo "<h3>Right now, you're here using a cookie.<br>This means that if you close 
		this page, you'll automatically be signed in for the next 7 days when you come back to us.
		If you choose to logout, this cookie will be destroyed, and you'll have log back in again on your next visit.</h3>";
		
		}
			
		else
		{
			echo "<h3>Right now, you're here using a session. This means that once you close your browser, you'll be signed out,
		and on your next visit you'll have to sign back in again.</h3>";
		}
			?>
		<a href="logout.php"><button class="button"><span>Logout</span></button></a>
		
	<?php 
	}
	else
	{
	?>
<!--	#BEBCB9-->
	
		<h1>Welcome to the site!</h1>
		<a href="login.php"><button class="button"><span>Login</span></button></a>
		<a href="register.php"><button class="button"><span>Register</span></button></a>
		
		
	<?php 
	}
	?>
	</div>
</body>
</html>