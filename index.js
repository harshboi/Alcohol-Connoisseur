//Event listener variable for when button is pressed
var update = document.getElementById('filter-update-button');

//Event listener action for when button is pressed
update.addEventListener("click", filterPosts);


//grab resources for the sort
function filterPosts(event) {
  var textFilter = document.getElementById('filter-text').value;
  textFilter = textFilter.toUpperCase();
  var postTextFilter = document.getElementById('posts');
  var postBox = postTextFilter.getElementsByClassName('post')


  filterTextDescription(postBox, postTextFilter, textFilter);
}

//Search the documents and hide/unhide matching posts
function filterTextDescription(postBox, postTextFilter, textFilter) {
  var postTextFilterDescription = postTextFilter.getElementsByTagName('a');
  var i = postBox.length;
  while (i--) {
    if (postTextFilterDescription[i].text.toUpperCase().indexOf(textFilter) > -1) {
      postBox[i].style.display = '';
    } else {
      postBox[i].style.display = 'none';
    }
  }
}