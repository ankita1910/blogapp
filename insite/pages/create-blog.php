<?php
	session_start();
?>
<!DOCTYPE html>
<head>
	<?php require('../common/common-resources.php'); ?>
	<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../styles/create-blog.css" />
	<script type="text/javascript" src="../scripts/create-blog.js"></script>
</head>
<body>
	<!-- Checking if it is an edit request -->
	<!-- Add contenteditable code here -->
	<div class="create-blog-container">
		<?php require('../common/header.php'); ?>
		<div class="create-blog-wrap">
			<div class="cb-heading">
				<div class="__text">CREATE A BLOG
				</div>
			</div>
			<div class="cb-contents">
				<div class="cb-title">
					<label for="cb-title-text">Name of the BLOG</label>
					<input type="text" name="cb-title-text" id="cb-blog-title">
				</div>
				<div class="cb-text">
					<label for="cb-contents-text">Pen down your thoughts!</label>
					<div class="cb-user-content" contenteditable="true" placeholder="start writing">
					</div>
				</div>
				<div class="cb-image">
				</div>
			</div>
			<div class="action-buttons">
				<div class="see-preview">
				</div>
				<div class="create-blog" id="create-blog-action">
					CREATE BLOG
				</div>
			</div>
		</div>
	</div>
	<div class="overlay-container">
	</div>
</body>
</html>