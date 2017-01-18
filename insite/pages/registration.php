<?php
	//Start session
session_start();
include 'db_connect.php';

if(isset($_POST['email']) && isset($_POST['password']) 
	&& !empty($_POST['email']) && !empty($_POST['password']))
{
	//Get email and password from form fields
	$user_email = $_POST['email'];
	$user_password = $_POST['password'];

	//Registation code
	if(isset($_POST['submit']) && isset($_POST['username']) && !empty($_POST['username']))
	{
			//Get user name from  fields
		$user_name = $_POST['username'];

		$insert_user_details_query = "INSERT INTO user (user_name, password, email)
		VALUES ('$user_name', '$user_password', '$user_email')";

		if($conn -> query($insert_user_details_query))
		{
				//Set the session variable after succesful registration
			$_SESSION['username'] = $user_name;
			$_SESSION['user_id'] = $conn->insert_id;
			header("Location: ../pages/home.php");
		}
		else
		{
			$error_message = "";
				//1062: Duplicate email id error
			if('1062' == $conn -> errno){
				$error_message = "Email id already exists." ;
			}
			else{
				$error_message =  "Error while inserting. Please try again.<br>". $conn -> error;
			}
		}						
	}
	//Login code
	else
	{
		//Login user validation query 
		$validate_user_query = "SELECT user_name, user_id FROM user
		WHERE email = '$user_email' AND password = '$user_password'";


		$results = $conn -> query($validate_user_query);

		if (!$conn->error && $row = $results -> fetch_assoc()) 
		{
			$_SESSION['username'] = $row['user_name'];
			$_SESSION['user_id'] = $row['user_id'];
			echo json_encode(array('status' => 'success'));
				//echo json_encode($response);	
		}
		else
		{
			echo json_encode(array('status' => 'failure', 'error' => "Invalid username or password"));
		}

	}
}
//Close database connetion
$conn->close();
?>
