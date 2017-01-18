$(document).ready(function(){
	populateBlog();
});

function populateBlog(){
	$.ajax({
		url: '../pages/blogs.php',
		data:{
			'cmd': 'GETUSERBLOGS'
		},
		type:'GET',
		dataType:'json',
		success:function(response){
			createBlogStructure(response, 'all-user-blog', true);	
		},
		error:function(err){
			console.log(err);
		}
	});
}
