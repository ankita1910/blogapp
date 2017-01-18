function createBlogStructure(response, divBlockId, isUserBlogsRequest){
	var allBlogContainerId = document.getElementById(divBlockId);
	response.forEach(function(blog){
		var blogId = blog.blog_id;
		var blogContainerDiv = createElement('div', '', {
			'id': blog.blog_id,
			'class': "blog-node"
		});
		var blogWrap = createElement('div', '', {'class': "blog-wrap"});
		var blogAddOns = createElement('div', '', {'class': "blog-addons"});

		//Blog wrap childs
		var blogHeading = createElement('div', '', {'class': "blog-heading"});
		var blogContents = createElement('div', blog.blog_content, {'class': "blog-contents"});

		//Heading childs
		var blogTitle = createElement('div', blog.blog_title, {'class': "blog-title"});

		/* Adding onclick event listener to blog title */
		blogTitle.addEventListener('click', function() {
			window.location = "../pages/blog-details.php?blog-id=" + blogId;
		}); 
		
		var blogAuthor = createElement('div', 'Written by ' + blog.user_name, {'class': "blog-author"});
		blogHeading.appendChild(blogTitle);
		blogHeading.appendChild(blogAuthor);

		blogWrap.appendChild(blogHeading);
		blogWrap.appendChild(blogContents);

		//Addons child
		var date = new Date(Date(blog.blog_created_date));
		var blogDateStr = date.getDate() + " " + date.toLocaleString("en-us", { month: "long" }) + " " + date.getFullYear();
		var dateDiv = createElement('div', blogDateStr, {'class': "__date"});
		blogAddOns.appendChild(dateDiv);
		var likeDiv = createElement('div', '', {'class': "__likes"});
		blogAddOns.appendChild(likeDiv);
		
		if(isUserBlogsRequest){
			likeDiv.style.pointerEvents = 'none';

			var editButton = createElement('img', '', 
			{
				'src': "../resources/edit-icon.png"
			})
			
			var editButtonDiv = createElement('div', '', {'class': "__edit"});
			editButtonDiv.onclick = function(){
				editBlog(blogId);
			}
			editButtonDiv.appendChild(editButton);

			blogAddOns.appendChild(editButtonDiv);

			var deleteButton = createElement('img', '', 
			{
				'src' : "../resources/delete-icon.png"
			})

			var deleteButtonDiv = createElement('div', '', {'class': "__delete"});
			deleteButtonDiv.onclick = function(){
				deleteBlog(blogId);
			};
			deleteButtonDiv.appendChild(deleteButton);
			blogAddOns.appendChild(deleteButtonDiv);
		}
		else{
			//likeDiv.style.pointerEvents = 'none';
		}
		
		//Like div child
		var likeCounter = createElement('span', blog.likes, {'class': "like-counter"});
		var likeAction = createElement('span', 'LIKES', {'class': "like-action-element"});
		//Add on click event to the like action
		likeAction.addEventListener('click', function(){
			updateLikeCount(blogId, likeCounter);
		})
		
		likeDiv.appendChild(likeCounter);
		likeDiv.appendChild(likeAction);

		//Append blog wrap and blog add ons the the blog container div
		blogContainerDiv.appendChild(blogWrap);
		blogContainerDiv.appendChild(blogAddOns);

		allBlogContainerId.appendChild(blogContainerDiv);
	})
}

function createElement(element,content, attrs){
	var newElement = document.createElement(element);
	if (content){
		var t = document.createTextNode(content);
		newElement.appendChild(t);
	}
	setAttributes(newElement, attrs);
	return newElement
}

function setAttributes(element, attrs){
	for(var key in attrs){
		element.setAttribute(key, attrs[key]);
	}
}

function editBlog(blogId){
	window.location.href = '../pages/blog-details.php?blog-id=' + blogId + '&edit=true';
}

function deleteBlog(blogId){
	$.ajax({
		type: "post",
		url: "../pages/blogs.php",
		data: {	
			cmd: "DELETEBLOG",
			blog_id: blogId
		},
		dataType: "json",
		success: function(response) {
			if("success" == response.status){
				alert("Blog deleted successfully");
				var elementToRemove = document.getElementById(blogId);
				elementToRemove.parentNode.removeChild(elementToRemove);			
			}
			else{
				alert(response.error);
			}
		},
		error: function(error) {
			console.log(error);
		}
	});
}