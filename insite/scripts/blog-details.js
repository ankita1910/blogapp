var objBlogDetails = {};

$(document).ready(function() {
	$.ajax({
		type: "get",
		url: "../pages/blogs.php",
		data: {
			cmd: "GETBLOGDETAILS",
			blog_id: blogId
		},
		success: function(response) {
			populateBlog(JSON.parse(response));
		},
		error: function(error) {
			console.log(error);
		}
	});
	if(isEditRequest == true) {	
		editBlog();
	}
});

populateBlog = function(response) {
	document.getElementsByClassName("bd-title")[0].innerHTML = response.blog_title;
	var date = new Date(Date(response.blog_created_date));
	var blogDateStr = date.getDate() + " " + date.toLocaleString("en-us", { month: "long" }) + " " + date.getFullYear();
	document.getElementsByClassName("bd-date")[0].innerHTML = blogDateStr;
	document.getElementsByClassName(" __text")[0].innerHTML = response.blog_content;
	document.getElementById('author-name').innerHTML = response.user_name;
}

editBlog = function() {
	document.getElementsByClassName("bd-contents")[0].setAttribute("contentEditable", "true");

	document.getElementsByClassName("edit-blog-action")[0].onclick = function() {
		var updatedBlogContent = document.getElementsByClassName("bd-contents")[0].innerHTML;
		$.ajax({
			type: "post",
			url: "../pages/blogs.php",
			dateType: "json",
			data: {
				cmd: "EDITBLOG",
				blog_id: blogId,
				blog_category: "Happiness",
				blog_content: updatedBlogContent
			},
			success: function(response){
				window.location.href = " ../pages/home.php";
			},
			error: function(){
				console.log("Error occured while editing the blog");
			}

		});
	};
}