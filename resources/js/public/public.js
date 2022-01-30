for(i of document.querySelectorAll('.single-post-gallery .thumbs img')) {
  i.addEventListener('click', function(e) {
    document.querySelectorAll('.single-post-gallery .main img')[0].src = e.target.getAttribute('original');
  });
}

document.querySelector('#like-dislike').addEventListener('click', function() {
  let likeButton = this;
  if( likeButton.dataset.postId != undefined ) {
    fetch(`/like/${likeButton.dataset.postId}`)
    .then(response => response.json())
    .then(function(data) {
      console.log('data', data);
      if( data.liked ) {
        likeButton.classList.add("liked");
        likeButton.classList.add("jump");
      }else {
        likeButton.classList.remove("liked");
        likeButton.classList.remove("jump");
      }
      document.querySelector('#like-dislike span').innerHTML = data.count;
    });
  }

});