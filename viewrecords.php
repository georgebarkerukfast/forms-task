<?php
include 'Database.php';

function validation($data) 
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

 $database = new Database("darrentask");
//$database = new Database("george_barker");
$records = $database->getAllRecords();

?>


<html>
<head>
<link rel="stylesheet" href="css/style.css">
	<title></title>
</head>
<body>

<div id="formContainer">
	<h1>All Records</h1>
	<?php 
	while ($record = $records->fetch_assoc()) //loop through the records.
		{//the array index is associative; can specify a column in the table.
		
			echo "<div id='record'>"; //start of record div
			echo "User ID: " . validation($record['userid']) . "<br>";
			echo "Name: " . validation($record['firstname']) . " " . validation($record['surname']) . "<br>";
			echo "Email: " . validation($record['email']) . "<br>";
			echo "Mobile number: " . validation($record['mobilenumber']) . "<br>";
			if ($record['homenumber'] != "")
				echo "Home number: " . validation($record['homenumber']) . "<br>";
			echo "Address line 1: " . validation($record['addressline1']) . "<br>";
			if ($record['addressline2'] != "")
				echo "Address line 2" . validation($record['addressline2']) . "<br>";
			echo "City: " . validation($record['city']) . "<br>";
			if ($record['county'] != "")
				echo "County: " . validation($record['county']) . "<br>";
			echo "Postcode: " . validation($record['postcode']) . "<br>";
			echo "Country: " . validation($record['country']) . "<br>";
			echo "Date of birth: " . validation($record['dateofbirth']) . "<br>";
			echo "</div>"; //end of record div
			
		}
	?>
	
	
</div>

</body>
</html>