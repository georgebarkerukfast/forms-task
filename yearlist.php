<?php
date_default_timezone_set("Europe/London");
$currentYear = date("Y") - 1;

?>

<select class='largeInputMonthYear' name='dobYear' required title='Please select a year'>

<?php

if (isset($_POST['dobYear']) && $_POST['dobYear'] != "")
{
	$year = $_POST['dobYear'];
	echo "<option value='$year' selected>$year</option>";
}

else
{
	echo "<option value='' disabled selected>Year</option>";
}
	
for ($year = $currentYear; $year >= 1900; $year--)
{
	
	echo "<option value='$year'>$year</option>";
}

?>

</select>