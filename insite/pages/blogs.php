<?php
	//Start session
session_start();
include 'db_connect.php';

if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) 
{
	$user_id = $_SESSION['user_id'];
}
	//Get the command to call the functions
if(isset($_REQUEST['cmd']))
{
	switch($_REQUEST['cmd']) 
	{
		case "GETALLBLOGS" : 
		$all_blog_query = "SELECT b.blog_id, b.blog_title, b.blog_content, b.blog_category, 
		b.blog_created_date, b.likes, u.user_name
		FROM blog b
		INNER JOIN user u 
		ON u.user_id = b.user_id
		ORDER BY blog_created_date DESC";

		getBlogs($all_blog_query);
		break;

		case "GETUSERBLOGS" : 
		$user_blog_query = "SELECT b.blog_id, b.blog_title, b.blog_content, b.blog_category, 
		b.blog_created_date, b.likes, u.user_name
		FROM blog b
		INNER JOIN user u 
		ON u.user_id = b.user_id AND u.user_id = '$user_id'
		ORDER BY blog_created_date DESC";

		getBlogs($user_blog_query);
		break;

		case "LIKEBLOG" :
		if(isset($_REQUEST['blog_id']) && !empty($_REQUEST['blog_id']))
		{
			incrementLikeCounter();
		} 
		break; 

		case "EDITBLOG":
		if(isset($_REQUEST['blog_id']) && !empty($_REQUEST['blog_id'])
			&& isset($_REQUEST['blog_content']) && !empty($_REQUEST['blog_content'])
			&& isset($_REQUEST['blog_category']) && !empty($_REQUEST['blog_category']))
		{
			editBlog();
		}
		break;

		case "DELETEBLOG": 
		if(isset($_REQUEST['blog_id']) && !empty($_REQUEST['blog_id']))
		{
			deleteBlog();
		} 
		break;

		case "CREATENEWBLOG":
		if(isset($_POST['blog_category']) && isset($_POST['blog_content']) 
			&& !empty($_POST['blog_content']) && !empty($_POST['blog_category'])) {

			createNewBlog();
		}
		break;

		case "GETBLOGDETAILS":
			if(isset($_REQUEST['blog_id']) && !empty($_REQUEST['blog_id'])) {

				getBlogDetails($_REQUEST['blog_id']);
			}
		break; 
	}
}

$conn->close();

function getBlogs($query)
{
	global $conn;
	$json_response = array();
	$results = $conn -> query($query);
	if (!$conn->error) 
	{
		while($row = $results -> fetch_assoc()) 
		{
			$row_array = array();
			$row_array['blog_id'] = $row['blog_id'];
			$row_array['blog_title'] = $row['blog_title'];
			$row_array['blog_content'] = $row['blog_content'];
			$row_array['blog_category'] = $row['blog_category'];
			$row_array['blog_created_date'] = $row['blog_created_date'];
			$row_array['user_name'] = $row['user_name'];
			$row_array['likes'] = $row['likes'];

			array_push($json_response, $row_array);
		}
		echo json_encode($json_response);
	}
	else{
		die("Error: could not connect " . $conn->error);
	}
}

function incrementLikeCounter()
{
	global $conn;
	$blog_id = $_REQUEST['blog_id'];
	$update_like_query = "UPDATE blog
	SET likes = likes + 1
	WHERE blog_id = '$blog_id'";

	if ($conn -> query($update_like_query))
	{
		//echo "Record updated successfully";
	}

	$get_likes_count_query = "SELECT likes FROM blog WHERE blog_id = '$blog_id'";
	$query_output = $conn -> query($get_likes_count_query);

	if(!$conn->error)
	{
		while($row = $query_output -> fetch_assoc())
		{
			$likes = [];
			//print_r($row[likes]);
			echo json_encode($likes['likes'] = $row['likes']);
		} 
	}	
}

function editBlog()
{
	global $conn;
	$blog_category = strip_tags($_REQUEST['blog_category']);
	$blog_content = strip_tags($_REQUEST['blog_content']);
	$blog_id = $_REQUEST['blog_id'];

	$update_blog_query = "UPDATE blog
	SET blog_content = '$blog_content',
	blog_category = '$blog_category'
	WHERE blog_id = '$blog_id'";

	if ($conn -> query($update_blog_query))
	{
		echo "Record updated successfully";
	}
}

function deleteBlog()
{
	global $conn;
	$blog_id = $_REQUEST['blog_id'];
	$delete_blog_query = "DELETE FROM blog 
	WHERE blog_id = '$blog_id'";
	if ($conn -> query($delete_blog_query))
	{
		echo json_encode(array('status' => 'success'));
	}
	else
	{
		echo json_encode(array('status' => 'failure', 'error' => "An error occurred"));
	}
}

function createNewBlog() {

	global $conn, $user_id;
	$blog_category = strip_tags($_POST['blog_category']);
	$blog_content = strip_tags($_POST['blog_content']);
	$blog_title = strip_tags($_POST['blog_title']);
	
	$create_blog_uery = "INSERT INTO blog (blog_category, blog_content, user_id, blog_title) 
						 VALUES ('$blog_category', '$blog_content', '$user_id', '$blog_title')";

	if($conn -> query($create_blog_uery)) {
		echo "Blog created successgully";
	} else {
		echo "Error occurred. ".$conn->error;
	}
}

function getBlogDetails() {

	global $conn;
	$blog_id = $_REQUEST['blog_id'];

	$getblogDetails_query = "SELECT b.blog_id, b.blog_title, b.blog_content, b.blog_category, 
								b.blog_created_date, b.likes, u.user_name
							FROM blog b
							INNER JOIN user u 
							ON u.user_id = b.user_id
							WHERE blog_id = '$blog_id'";

	$json_response = array();
	$results = $conn -> query($getblogDetails_query);
	
	if (!$conn->error) {
		while($row = $results -> fetch_assoc()) {
			$row_array = array();
			$row_array['blog_title'] = $row['blog_title'];
			$row_array['blog_content'] = $row['blog_content'];
			$row_array['blog_category'] = $row['blog_category'];
			$row_array['blog_created_date'] = $row['blog_created_date'];
			$row_array['likes'] = $row['likes'];
			$row_array['user_name'] = $row['user_name'];

			array_push($json_response, $row_array);
		}
		echo json_encode($row_array);
	} else {
		echo "Error";
	}
}
?>