<div class="header">
	<div class="left-container" class="menu-item" >
		<a href="../pages/home.php"/>
			<div class="__title " id="blog-app">
				BLOG APP
			</div>
		</a>
	</div>
	<div class="right-container">
		<a href="create-blog.php">
			<div class="menu-item create-blog">
				<?php if(isset($_SESSION['username'])) {
						echo "CREATE BLOG";
				} ?>
			</div>
		</a>
		<div class="menu-item login" id="login-button" class="header-text">
			<?php 
			if(!isset($_SESSION['username']))
			{
				echo 'LOGIN';
			}; 
			?>
		</div>
		<div class="menu-item username" id="username" class="header-text">
			<?php 
			if(isset($_SESSION['username']))
			{
				echo $_SESSION['username'];
			}; 
			?>
		</div>
		<div class="menu-item logout">
			<a href = "../pages/logout.php" id="logout-button" class="header-text">
				<?php 
				if(isset($_SESSION['username']))
				{
					echo 'LOGOUT';
				}; 
				?>
			</a>
		</div>
		<div class="menu-item">
			<a href = "../pages/dashboard.php" id="dashboard" class="header-text">
				<?php 
				if(isset($_SESSION['username']))
				{
					echo 'Profile';
				}; 
				?>
			</a>
		</div>
	</div>
</div>