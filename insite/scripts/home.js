$(document).ready(function(){
	var loginPopup = document.getElementsByClassName('overlay-container')[0],
		loginButtonId = document.getElementById('login-button'),
		logoutButtonId = document.getElementById('logout-button'),
		usernameText = document.getElementById('username');

	populateBlog();
	displayLoginPopUp(loginPopup, loginButtonId);
	submitForm(loginPopup, loginButtonId, logoutButtonId, usernameText);
	displayRegistrationForm(loginPopup);
});

function displayRegistrationForm(loginPopup){
	var id = document.getElementById('sign-up-button');
	id.onclick = function(){
		document.getElementById('myModal-registration').style.display = 'block';
		loginPopup.style.display = "none";
	}

		//Close the pop up on click of 'X' on the pop up
	var closeXElement = document.getElementsByClassName("close")[1];
	closeXElement.onclick = function() {
    	document.getElementsByClassName('overlay-container')[1].style.display = "none";
	}

		//Close the pop up on click of any where on the window
	window.onclick = function(event) {
	    if (event.target == loginPopup) {
	        document.getElementsByClassName('overlay-container')[1].style.display = "none";
	    }
	}
}

//Function to display the login pop up
function displayLoginPopUp(loginPopup, loginButtonId){
	//Display logn pop up
	loginButtonId.onclick = function(){
		loginPopup.style.display = "block";
	}

	//Close the pop up on click of 'X' on the pop up
	var closeXElement = document.getElementsByClassName("close")[0];
	closeXElement.onclick = function() {
    	loginPopup.style.display = "none";
	}

	//Close the pop up on click of any where on the window
	window.onclick = function(event) {
	    if (event.target == loginPopup) {
	        loginPopup.style.display = "none";
	    }
	}	
}

//On submit of login form. Logs in the user after user verification
function submitForm(loginPopup, loginButtonId, logoutButtonId, usernameText){
	var loginSubmitButtonId = document.getElementById('login-submit');

	loginSubmitButtonId.addEventListener('click', function(){
		var loginElements = document.querySelectorAll('#email-id, #password');

		$.ajax({
			url: '../pages/registration.php',
			data:{
				'email':loginElements[0].value,
				'password':loginElements[1].value,
			},
			type:'POST',
			dataType:'json',
			success:function(response){
				if('success' === response.status){
					loginPopup.style.display = "none";
					// loginButtonId.style.display = "none";
					// usernameText.style.display = 'block';
					// logoutButtonId.style.display = 'block';
					window.location.href = "../pages/home.php"

					logoutButtonId.onclick = function(){
						// logoutButtonId.style.display = 'none';
						// loginButtonId.style.display = "block";
						// usernameText.style.display = "none";
						window.location.href = "../pages/logout.php";
					}
				}else if('failure' === response.status){
					document.getElementById('login-error').innerHTML = response.error;
				}
			},
			error:function(err, status){
				console.log(err);
				console.log(status);
			}
		});
	});
}

//Function to populate the blog
function populateBlog(){
	//Ajax call to get all the blogs
	$.ajax({
		url: '../pages/blogs.php',
		data:{
			'cmd': 'GETALLBLOGS'
		},
		type:'GET',
		dataType:'json',
		success:function(response){
			//Draw structure and populate blog on the UI
			createBlogStructure(response, 'all-blog', false);	
		},
		error:function(err){
			console.log(err);
		}
	});
}

function updateLikeCount(id, likeCounter){
	$.ajax({
		url: '../pages/blogs.php',
		data:{
			'cmd': 'LIKEBLOG',
			'blog_id':id
		},
		type:'GET',
		dataType:'json',
		success:function(response){
			//Update like counter on the UI
			likeCounter.innerHTML = response;
		},
		error:function(err){
			console.log(err);
		}
	});
}