var quickAddBtn = document.getElementById('quick-add-button');

if( quickAddBtn ){
	quickAddBtn.addEventListener('click', function() {
		alert('Clicked');
		// var title = document.querySelector('.admin-quick-add, [name="title"]').value;
		// var content = document.querySelector('.admin-quick-add, [name="content"]').value;

		// var ourPostData = {
		// 	"title" : title,
		// 	"content" : content
		// }

		// var createPost = new XMLHttpRequest();

		// createPost.open('POST', 'http://localhost/wordpressThemeDevelopment/Theme1/wp-json/wp/v2/posts');
		// createPost.setRequestHeader('X-WP-Nonce', additionalData.nonce);
		// createPost.setRequestHeader('Content-Type', 'application/json;charset:utf=8');
		// createPost.send(JSON.stringify(ourPostData));
	});
}