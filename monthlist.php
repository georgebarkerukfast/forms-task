<select class="largeInputMonthYear" name="dobMonth" required title="Please select a month" value="<?php if (isset($_POST['dobMonth'])) echo $_POST['dobMonth']  ?>">
	
<?php 
 if (isset($_POST['dobMonth']))
{
	$month = $_POST['dobMonth'];
	
	echo "<option value='$month' selected>$month</option>";
}

else
{
	echo "<option value='' disabled selected>Month</option>";
} 
?>
<!-- <option value='' disabled selected>Month</option> -->
	<option value="January">January</option>
	<option value="February">February</option>
	<option value="March">March</option>
	<option value="April">April</option>
	<option value="May">May</option>
	<option value="June">June</option>
	<option value="July">July</option>
	<option value="August">August</option>
	<option value="September">September</option>
	<option value="October">October</option>
	<option value="November">November</option>
	<option value="December">December</option>
</select>