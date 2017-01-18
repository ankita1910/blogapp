<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>BlogApp - Profile</title>
	<?php require('../common/common-resources.php'); ?>
	<link rel="stylesheet" type="text/css" href="../styles/home.css" />
	<link rel="stylesheet" type="text/css" href="../styles/dashboard.css" />
	<script type="text/javascript" src="../scripts/common.js"></script>
	<script type="text/javascript" src="../scripts/dashboard.js"></script>
</head>
<body>
	<div class="main-container">

		<?php require('../common/header.php'); ?>

		<!-- Start of div to display all the blog -->
		<div id="all-user-blog"></div>
		<!-- Start of div to display all the blog -->
</body>
</html>