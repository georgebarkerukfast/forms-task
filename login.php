<?php 
session_start();
include 'Database.php';
$database = new Database("darrentask");
$success;
if (isset($_POST['login']))
{
	$email = $_POST['email'];
	$password = $_POST['password'];
	$results = $database->login($email, $password);
	$success = $results->num_rows;
	
	if ($success > 0)
	{
		$_SESSION['barker_logged_in'] = $email;
		
 		if (isset($_POST['rememberme']))
 		{
 			
 			setcookie("barker_logged_in", $email, time()+(86400 * 7));
 		}
 		
 		header('Location: index.php');
	}
	 
	
}
?>

<html>
<head>
	<title></title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div id="loginFormContainer">
		<h1>George's login page!</h1><br>
		<form id='loginForm' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
			<label for="email">Email: </label>
			<input class='largeInput nospace' type='text' name='email' value='<?php if (isset($_POST['email'])) echo htmlspecialchars($_POST['email']); ?>'>
			<br><br>
			<label for="password">Password: </label>
			<input class='largeInput' type="password" name="password">
			<br>
			<p class='red'><?php if (isset($success)) if ($success == 0) echo "<br>Oops!<br>The email or password you've entered is incorrect.<br>"?></p><br>
			<label for="rememberme">Remember me for 7 days: </label>
			<input id='checkbox' type="checkbox" name="rememberme">
			<br><br>
			<input id='largeSubmit' type="submit" value="Log in!" name="login">
			<br><br>
			<!-- label that says about either being wrong  -->
			<p>Not already registered with us?<br>You're missing out! <a href="index.php"><i>Click here </i></a>&nbsp;to get started.</p>
			<br>
			<p>Forgotten your password?<br>Oh dear! <a href="index.php"><i>Click here  </i></a>	&nbsp;to reset.</p>
		</form>
	</div>
</body>
</html>