var createBlogObj = {};

$(document).ready(function() {
	/* On click bindings to functions */
	var createBlogButton = document.getElementById('create-blog-action');
	createBlogButton.onclick = createBlogObj.insertBlogDetails;

});

createBlogObj.insertBlogDetails = function() {
	var blogTitle = document.getElementById("cb-blog-title").value;
	var blogContent = document.getElementsByClassName("cb-user-content")[0].innerHTML;
	var blogCategory = "Happiness";

	$.ajax({
		type: "post",
		url: "../pages/blogs.php",
		data: {
			cmd: "CREATENEWBLOG",
			blog_category: blogCategory,
			blog_content: blogContent,
			blog_title: blogTitle 
		},
		success: function(response) {
			window.location = "../pages/home.php";
		},
		error: function(error) {
			console.log(error);
		}
	});
}