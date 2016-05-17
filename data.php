<?php
session_start();
include 'Database.php';

if (isset($_SESSION['firstname']))
{
	$firstname = $_SESSION['firstname'];
	$surname = $_SESSION['surname'];
	$email = $_SESSION['email'];
	$mobile = $_SESSION['mobile'];
	$home = $_SESSION['home'];
	$addressline1 = $_SESSION['addressline1'];
	$addressline2 = $_SESSION['addressline2'];
	$city = $_SESSION['city'];
	$county = $_SESSION['county'];
	$postcode = $_SESSION['postcode'];
	$country = $_SESSION['country'];
	$dateofbirth = $_SESSION['dateofbirth'];
	$gender = $_SESSION['gender'];
	
	$password = validation($surname) . substr(validation($firstname), 0, 1) . rand(1,9) . rand(1,9) . rand(1, 9);
	
 	$database = new Database("darrentask");
//	$database = new Database("george_barker");
	$database->insertRecord($firstname, $surname, $email, $mobile, $home, 
			$addressline1, $addressline2, $city, $county, $postcode, $country, $dateofbirth, $gender, $password);
	
}

else
{
	header('Location: register.php');
}

function validation($data) 
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

		
?>


<html>
<head>
<link rel="stylesheet" href="css/style.css">
	<title></title>
</head>
<body>

<div id="formContainer">
	<h1>Thank you for registering, <?php echo validation($firstname) ?>!</h1>
	<h2>To confirm, the information you entered is...</h2>
	<ul>
		<li>Name: <?php echo validation($firstname) . " " . validation($surname) ?></li>
		<li>Gender: <?php echo $gender ?></li>
		<li>Email: <?php echo $email ?></li>
		<li>Mobile number: <?php echo validation($mobile) ?></li>
		
		<?php if ($home != "")
				echo "<li>Home number: " . $home . "</li>"; ?>
		
		<li>Address Line 1: <?php echo validation($addressline1) ?></li>
		
		<?php if ($addressline2 != "")
				echo "<li>Address Line 2: " . validation($addressline2) . "</li>"; ?>
		
		<li>City: <?php echo $city ?></li>
		
		<?php if ($county != "")
				echo "<li>County: " . validation($county) . "</li>"; ?>
			
		<li>Postcode: <?php echo validation($postcode) ?></li>
		<li>Country: <?php echo validation($country) ?></li>
		<li>Date of birth: <?php echo validation($dateofbirth) ?></li>
<!-- 		length of first & last no more than 23 chars? -->
		<li>Password: <?php echo $password ?></li>
	</ul>
	<h2>This information has now been added to our<a href="viewrecords.php"> database</a>.</h2>
	<br>
	<h2>Now you're signed up, you can login <a href="login.php">here</a>, using the password <?php echo $password ?></h2>
</div>
	
</body>
</html>


