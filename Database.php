<?php

class Database
{
	private $name;
	private $databaseConnection;
	
	public function Database($name)
	{
		$this->name = $name;
		
		$this->databaseConnection = new mysqli("localhost", "root", "", $this->name);
// 		$this->databaseConnection = new mysqli("localhost", "george_barker", "pass123", $this->name);
		
		 if ($this->databaseConnection->connect_errno > 0)
		{
			die("Unable to connect to database, " . $database->connect_error);
		} 
	}
		
	public function insertRecord($firstname, $surname, $email, $mobile, $home, $addressline1, $addressline2, $city, $county, $postcode, $country, $dateofbirth, $gender, $password)
	{
		//Create statement object. Every database must have a statement object.
		$statement = $this->databaseConnection->stmt_init();
		
		//sql statement, ? represents a placeholder.
		$sql = "INSERT INTO users_forms VALUES(NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		
		//prepare an SQL statement for execution
		$statement->prepare($sql);
		
		//first param is data type of the following parameters for the query.
		$statement->bind_param("ssssssssssssss", $firstname, $surname, $email, $mobile, $home, $addressline1, $addressline2, $city, $county, $postcode, $country, $dateofbirth, $gender, $password);
		
		//executes the statement on the database side.
		$statement->execute();
		
	}
	
	public function login($email, $password)
	{
		$statement = $this->databaseConnection->stmt_init();
		
		$sql = "SELECT * FROM users_forms WHERE email= ? AND password = ?";
		
		$statement->prepare($sql);
		
		$statement->bind_param("ss", $email, $password);
		
		$statement->execute();
		
		$results = $statement->get_result();
		
		return $results;
	}
	
	public function getAllRecords()
	{
		$statement = $this->databaseConnection->stmt_init();
		
		$sql = "SELECT * FROM users_forms";
		
		$statement->prepare($sql);
		
		$statement->execute();

		$results = $statement->get_result();
		
		
		return $results;

		/*while ($record = $results->fetch_assoc()) //loop through the records.
		{
			//the array index is associative; can specify a column in the table.
			echo $record['productid'] . "<br>";
		}*/
	}
	
	public function getUser($email)
	{
		$statement = $this->databaseConnection->stmt_init();
		
		$sql = "SELECT * FROM users_forms WHERE email = ?";
		
		$statement->prepare($sql);
		
		$statement->bind_param("s", $email);
		
		$statement->execute();
		
		$results = $statement->get_result();
		
		return $results;
	}
	
	
}
