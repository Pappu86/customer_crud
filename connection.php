<?php
	$host = "localhost";
	$username = "root";
	$password = "";
	$db_name = "crud_db";
 
	$conn=new mysqli($host,$username,$password,$db_name);
	if(!$conn){
	    die("Database Connection Failed.". $conn->error);
	}