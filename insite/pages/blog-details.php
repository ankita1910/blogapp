<?php
	session_start(); 
	$blogId = $_REQUEST["blog-id"];
	$isEditRequest = false;
	if(isset($_REQUEST["edit"]) && $_REQUEST["edit"] == "true") {
		$isEditRequest = true;
	}
?>
<!DOCTYPE html>
<head>
	<?php require('../common/common-resources.php'); ?>
	<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../styles/blog-details.css" />
	<script type="text/javascript">
		var blogId = "<?php echo $blogId; ?>";
		var isEditRequest = "<?php echo $isEditRequest; ?>";
	</script>
	<script type="text/javascript" src="../scripts/blog-details.js"></script>
</head>
<body>
	<div class="main-container">
		<?php require('../common/header.php'); ?>
		<div class="blog-details-container">
			<div class="bd-heading">
				<div class="bd-title"></div>
				<div class="bd-author">Written by 
					<span id="author-name"></span>
				</div>
				<div class="bd-date"></div>
			</div>
			<div class="bd-contents">
				<div class="__text"></div>
			</div>
			<?php 
				if(isset($isEditRequest) && $isEditRequest) 
					{ 
			?>
				<div class="blog-addons">
					<div class="edit-blog-action">UPDATE BLOG</div>
				</div>
			<?php 
					} 
			?>
		</div>
		<div class="overlay-container">
		</div>
	</div>
</body>
</html>