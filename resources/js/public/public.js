for(i of document.querySelectorAll('.single-post-gallery .thumbs img')) {
  i.addEventListener('click', function(e) {
    document.querySelectorAll('.single-post-gallery .main img')[0].src = e.target.getAttribute('original');
  });
}