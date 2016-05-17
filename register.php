<?php

session_start();

//trim it, if trim still = "" then its bad
//if array has a count of > 0, then do the div

$errors = array();
$assocErrors = array();

function validate($string)
{
	$validatedString = $string;
	$validatedString = str_replace(" ", "", $validatedString);
	$validatedString = str_replace(range(0, 9), "", $validatedString);
	return $validatedString;
}

function isMonth($month)
{
	if ($month == "January" || "February" || "March" || "April" || "May" || "June" || "July" || "August" || "September" || "October" || "November" || "December")
	{
		return true;
	}
	
	else
	{
		return false;
	}
}

function dateCreator($day, $month, $year)
{
	if ($month == "January")
		$month = "01";
	else if ($month == "February")
		$month = "02";
	else if ($month == "March")
		$month = "03";
	else if ($month == "April")
		$month = "04";
	else if ($month == "May")
		$month = "05";
	else if ($month == "June")
		$month = "06";
	else if ($month == "July")
		$month = "07";
	else if ($month == "August")
		$month = "08";
	else if ($month == "September")
		$month = "09";
	else if ($month == "October")
		$month = "10";
	else if ($month == "November")
		$month = "11";
	else if ($month == "December")
		$month = "12";
					
	
	$completeDate = $day . "-" . $month . "-" . $year; 
	return $completeDate;
}

$phoneRegex = "^((\+44\s?\d{4}|\(?\d{5}\)?)\s?\d{6})|((\+44\s?|0)7\d{3}\s?\d{6})^";

$emailRegex = "[^@]+@[^@]+\.[a-zA-Z]{2,6}";

$htmlPostcodeRegex = "(^[Bb][Ff][Pp][Oo]\s*[0-9]{1,4})|(^[Gg][Ii][Rr]\s*0[Aa][Aa]$)|([Aa][Ss][Cc][Nn]|[Bb][Bb][Nn][Dd]|[Bb][Ii][Qq][Qq]|[Ff][Ii][Qq][Qq]|[Pp][Cc][Rr][Nn]|[Ss][Ii][Qq][Qq]|[Ss][Tt][Hh][Ll]|[Tt][Dd][Cc][Uu]\s*1[Zz][Zz])|(^([Aa][BLbl]|[Bb][ABDHLNRSTabdhlnrst]?|[Cc][ABFHMORTVWabfhmortvw]|[Dd][ADEGHLNTYadeghlnty]|[Ee][CHNXchnx]?|[Ff][KYky]|[Gg][LUYluy]?|[Hh][ADGPRSUXadgprsux]|[Ii][GMPVgmpv]|[JE]|[je]|[Kk][ATWYatwy]|[Ll][ADELNSUadelnsu]?|[Mm][EKLekl]?|[Nn][EGNPRWegnprw]?|[Oo][LXlx]|[Pp][AEHLORaehlor]|[Rr][GHMghm]|[Ss][AEGK-PRSTWYaegk-prstwy]?|[Tt][ADFNQRSWadfnqrsw]|[UB]|[ub]|[Ww][A-DFGHJKMNR-Wa-dfghjkmnr-w]?|[YO]|[yo]|[ZE]|[ze])[1-9][0-9]?[ABEHMNPRVWXYabehmnprvwxy]?\s*[0-9][ABD-HJLNP-UW-Zabd-hjlnp-uw-z]{2}$)";
  
$postcodeRegex = "/^[A-Z]{1,2}[0-9][0-9A-Z]? ?[0-9][A-Z]{2}$/i";

$firstname = $surname = $email = $mobile = $home = $addressline1 = $addressline2 = $city = $county = $postcode = $country = $dateofbirth = $dobDay = $dobMonth = $dobYear = $completeDob = $termsandconditions = $gender = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	if (isset($_POST['firstname']))
	{
		$_SESSION['firstname'] = $firstname = $_POST['firstname'];
		if ($firstname != "")
		{
			if (validate($firstname) == "")
				$assocErrors['firstname'] = "The firstname you have entered is not correct. Firstnames cannot contain numbers.";
		}
		
		else
		{
			$assocErrors['firstname'] = "Please enter a first name.";
		}
	}
	
	else
	{
		$assocErrors['firstname'] = "Please enter a first name.";
	}
	
	
	if (isset($_POST['surname']))
	{
		$_SESSION['surname'] = $surname = $_POST['surname'];
		if ($surname != "")
		{
			if (validate($surname) == "")
				$assocErrors['surname'] = "The surname you have entered is not correct. Surnames cannot contain numbers.";
		}
		
		else
		{
			$assocErrors['surname'] = "Please enter a surname.";
		}
	}
	
	else
	{
		$assocErrors['surname'] = "Please enter a surname.";
	}
	
	
	if (isset($_POST['gender']))
	{
		$_SESSION['gender'] = $gender = $_POST['gender'];
	}
	else
	{
		$assocErrors['gender'] = "Please select a gender.";
	
	}
	
	if (isset($_POST['email']))
	{
		$_SESSION['email'] = $email = $_POST['email'];
		if ($email != "")
		{
			if (filter_var($email, FILTER_VALIDATE_EMAIL) == false)
				$assocErrors['email'] = "The email you have entered is not correct.";
		}
		
		else
		{
			$assocErrors['email'] = "Please enter an email.";
		}
	}
	
	else
	{
		$assocErrors['email'] = "Please enter an email.";
	}
	
	if (isset($_POST['mobilenumber']))
	{
		$_SESSION['mobile'] = $mobile = $_POST['mobilenumber'];
		if ($mobile != "")
		{
			if (preg_match($phoneRegex, $mobile) == 0)
				$assocErrors['mobile'] = "The mobile number you have entered is not correct.<br>An example format of a valid input is '07825309640'.";
		}
		
		else
		{
			$assocErrors['mobile'] = "Please enter a mobile number.";
		}
	}
	
	else
	{
		$assocErrors['mobile'] = "Please enter a mobile number.";
	}
	
	if (isset($_POST['homenumber']))
	{
		$_SESSION['home'] = $home = $_POST['homenumber'];
		if ($home != "")
			if ((preg_match($phoneRegex, $home) == 0) && $home != "")
				$assocErrors['home'] = "The home number you have entered is not correct.<br>An example format of a valid input is '01612153711'.";
	}
	
	if (isset($_POST['addressline1']))
	{
		$_SESSION['addressline1'] = $addressline1 = $_POST['addressline1'];
		if ($addressline1 != "")
		{
			if (str_replace(" ", "", $addressline1) == "")
				$assocErrors['addressline1'] = "The address line 1 you have entered is not correct.";
		}
		
		else
		{
			$assocErrors['addressline1'] = "Please enter an address line 1.";
		}
	}
	
	else
	{
		$assocErrors['addressline1'] = "Please enter an address line 1.";
	}
	
	if (isset($_POST['addressline2']))
	{
		$_SESSION['addressline2'] = $addressline2 = $_POST['addressline2'];
		if ($addressline2 != "")
			if (str_replace(" ", "", $addressline2) == "")
				$assocErrors['addressline2'] = "The address line 2 you have entered is not correct.";
	}
	
	if (isset($_POST['city']))
	{
		$_SESSION['city'] = $city = $_POST['city'];
		if ($city != "")
		{
			if (validate($city) == "")
				$assocErrors['city'] = "The city you have entered is not correct.";
		}
		
		else
		{
			$assocErrors['city'] = "Please enter a city.";
		}
	}
	
	else
	{
		$assocErrors['city'] = "Please enter a city.";
	}
	
	if (isset($_POST['county']))
	{
		$_SESSION['county'] = $county = $_POST['county'];
		if ($county != "")
			if (validate($county) == "")
				$assocErrors['county'] = "The county you have entered is not correct.";
	}
	
	
	if (isset($_POST['postcode']))
	{
		$_SESSION['postcode'] = $postcode = $_POST['postcode'];
		if ($postcode != "")
		{
		
			if (preg_match($postcodeRegex, $postcode) == 0)
			{
				$assocErrors['postcode'] = "The postcode you have entered is not correct.<br>An example format of a valid input for a postcode is 'M15 5QJ'.";
			}
		}
		
		else
		{
			$assocErrors['postcode'] = "Please enter a postcode.";
		}
	}
	
	else
	{
		$assocErrors['postcode'] = "Please enter a postcode.";
	}
	
	
	
	if (isset($_POST['termsandconditions']))
	{
		$_SESSION['termsandconditions'] = $termsandconditions = $_POST['termsandconditions'];
	}
	
	else
	{
		$assocErrors['termsandconditions'] = "You must agree to the terms and conditions to proceed.";
	}
	
	if (isset($_POST['country']))
	{
		$_SESSION['country'] = $country = $_POST['country'];
	}
	
	else
	{
		$assocErrors['country'] = "Please select a country.";
	}
		
	
		if(isset($_POST['dobDay'], $_POST['dobMonth'], $_POST['dobYear']))
		{
			$dobDay = floatval($_POST['dobDay']);
			$dobMonth = $_POST['dobMonth'];
			$dobYear = floatval($_POST['dobYear']);
			
// 			var_dump(isMonth($dobMonth));
						
			if ( ((int)$dobDay == $dobDay) && ((int)$dobYear) == $dobYear)
			{				
				if ($dobDay >= 1 || $dobDay <= 31)
				{
					if ((($dobMonth == ("April" || "June" || "September" || "November")) && ($dobDay >= 31)))
					{
						$assocErrors['dob'] = "The month you have entered does not have that many days.";
					}
					
				
					if (($dobMonth == "February") && ($dobDay > 29))
					{
						$assocErrors['dob'] = "The month you have entered does not have that many days.";
					}
					
					else 
					{
						if (count($assocErrors) == 0)
						{
							$completeDob = dateCreator($dobDay, $dobMonth, $dobYear);
							$_SESSION['dateofbirth'] = $completeDob;
						}
					
					}
				}
			
				else //else for the dob being between 1 and 30
				{
					$assocErrors['dob'] = "This is an invalid date number!";
				}
			}
			
			else //else for any of the params not being a real number
			{
				$assocErrors['dob'] = "This is an invalid date!";
			}
		}
		
		else
		{
			
			$assocErrors['dob'] = "Please enter a date.";
		}
		
	if (count($assocErrors) == 0)
	{
		header('Location: data.php');
	}
}

?>

<html>
<head>
	<title>Form</title>
	<link rel="stylesheet" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
	<script>
		$(function() 
		  {
    		$('.nospace').on('keypress', function(e) 
			{
        		if (e.which == 32)
            	return false;
    		});
		});
	</script>
</head>
<body>
<?php if (count($assocErrors) != 0 ) {
		echo '<div id="errors">';
			echo '<p>Unfortunately, there were some issues with the information you\'ve provided.<br>These issues are highlighted in red below. Please correct these to proceed.</p>';
		echo '</div>';
}
	?>
<div id="formContainer">
	<h1>George's Form!</h1>
	
	<!--	By using this bit of PHP, XSS is prevented inside the URL -->
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
		<p>Fill in the details below to complete registration! <br> * Denotes a required field.</p><br>
		
	  <label for="firstname">Name*: </label>
	  <input class='largeInput nospace' type="text" name="firstname" placeholder="Firstname" value="<?php if (isset($_POST['firstname'])) echo htmlspecialchars($_POST['firstname']);  ?>" title="Please enter a firstname." required>
	  <input class='largeInput nospace' type="text" name="surname" placeholder="Surname" value="<?php if (isset($_POST['surname'])) echo htmlspecialchars( $_POST['surname']); ?>" title="Please enter a surname." required> <br>
	  <label class='red' for="firstname"><?php if (isset($assocErrors['firstname'])) echo $assocErrors['firstname'] ?></label><br>
	  <label class='red' for="surname"><?php if (isset($assocErrors['surname'])) echo $assocErrors['surname']?></label><br><br>
	  
	  <label for="gender">Gender*: </label>
<!-- 	  if checked  -->
	  <input class='radioPadding' type="radio" name="gender" value="male" 
	  <?php 
	  if (isset($_POST['gender'])) 
	  {
	  	if ($_POST['gender'] == "male")
	  	{
	  		echo "checked='checked'";
	  	}
	  }
	  ?>> Male
	  <input class='radioPadding' type="radio" name="gender" value="female" 
	  <?php 
	  if (isset($_POST['gender'])) 
	  {
	  	if ($_POST['gender'] == "female")
	  	{
	  		echo "checked='checked'";
	  	}
	  }
	  ?>> Female<br>
	  <label class='red' for="gender"><?php if (isset($assocErrors['gender'])) echo $assocErrors['gender']?></label><br><br>
	  
	  <label for="email">Email*: </label>
	  <input class='largeInput nospace' type="text" name="email" placeholder="" required pattern="<?php echo $emailRegex ?>" title="Please enter a valid email address." value="<?php if (isset($_POST['email'])) echo htmlspecialchars($_POST['email']);  ?>" ><br>
	  <label  class='red' for="email"><?php if (isset($assocErrors['email'])) echo $assocErrors['email']?></label><br>
	  
	  <br><label for="mobilenumber">Phone number: </label>
	  <input class='largeInput nospace' type="text" name="mobilenumber" placeholder="Mobile number*" pattern="<?php echo $phoneRegex ?>" value="<?php if (isset($_POST['mobilenumber'])) echo htmlspecialchars($_POST['mobilenumber']);  ?>" title="Please enter a valid phone number, eg. '07825309640'." required>
	  <input class='largeInput nospace' type="text" name="homenumber" placeholder="Home number" pattern="<?php echo $phoneRegex ?>" value="<?php if (isset($_POST['homenumber'])) echo htmlspecialchars($_POST['homenumber']);  ?>" title="Please enter a valid phone number, eg. '01612153711'."><br>
	  <label class='red' for="mobilenumber"><?php if (isset($assocErrors['mobile'])) echo $assocErrors['mobile']?></label><br>
	  <label class='red' for="homenumber"><?php if (isset($assocErrors['home'])) echo $assocErrors['home']?></label><br><br>
	  
	  <label for="addressline1">Address: </label>
	  <input class='largeInput' type="text" name="addressline1" placeholder="Address Line 1*" value="<?php if (isset($_POST['addressline1'])) echo htmlspecialchars($_POST['addressline1']);?>" required title="Please enter an address line 1.">
	  
<!--	  <label for="addressline2">Address Line 2</label><br>-->
	  <input class='largeInput' type="text" name="addressline2" placeholder="Address Line 2" value="<?php if (isset($_POST['addressline2'])) echo htmlspecialchars($_POST['addressline2']);?>"><br>
	   <label class='red' for="addressline1"><?php if (isset($assocErrors['addressline1'])) echo $assocErrors['addressline1']?></label><br>
	   <label class='red' for="addressline2"><?php if (isset($assocErrors['addressline2'])) echo $assocErrors['addressline2']?></label><br><br>
	  
	  <label for="city">City*: </label>
	  <input class='largeInput' type="text" name="city" value="<?php if (isset($_POST['city'])) echo htmlspecialchars($_POST['city']);  ?>" required title="Please enter a city."><br>
	  <label class='red' for="city"><?php if (isset($assocErrors['city'])) echo $assocErrors['city']?></label><br><br>
	  
	  <label for="county">County: </label>
	  <input class='largeInput' type="text" name="county" value="<?php if (isset($_POST['county'])) echo htmlspecialchars($_POST['county']);  ?>"><br><br>
	  <label class='red' for="county"><?php if (isset($assocErrors['county'])) echo $assocErrors['county']?></label><br>
	  
	  <label for="postcode" >Postcode*: </label>
	  <input class='largeInput' type="text" name="postcode" required pattern="<?php echo $htmlPostcodeRegex ?>" title="Please enter a valid postcode, eg. 'M15 5QJ'" value="<?php if (isset($_POST['postcode'])) echo htmlspecialchars($_POST['postcode']);  ?>" ><br>
	  <label class='red' for="postcode"><?php if (isset($assocErrors['postcode'])) echo $assocErrors['postcode']?></label><br><br>
	  
	  <label for="country">Country*: </label>
	  <?php include 'countrylist.php'; ?><br>
	  <label class='red' for="country"><?php if (isset($assocErrors['country'])) echo $assocErrors['country']?></label><br><br>
	   
	  <label for="dateofbirth">Date of Birth*: </label>
	  <!--<input class='tallLargeInput' type="date" name="dateofbirth" placeholder="Date of birth" required>-->
	  <input type="text" class="largeInputDay" name="dobDay" maxlength="2" placeholder="Day" value="<?php if (isset($_POST['dobDay'])) echo htmlspecialchars($_POST['dobDay']);  ?>" >
	  <?php include 'monthlist.php'; ?>
	  <?php include 'yearlist.php'; ?>
	  <label class='red' for="dateofbirth"><?php if (isset($assocErrors['dob'])) echo $assocErrors['dob']?></label><br>
	  <br><br>
	  
		<label for="termsandconditions">Do you agree to the terms and conditions?*</label>
	  <input id='largeInput' type="checkbox" name="termsandconditions" required><br>
	  <label class='red' for="termsandconditions"><?php if (isset($assocErrors['termsandconditions'])) echo $assocErrors['termsandconditions']?></label><br><br>
	  <input id='largeSubmit' type="submit" value="Register!"><br>
	</form>
</div>	

</body>
</html>