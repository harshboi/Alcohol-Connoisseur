var modal = document.getElementById('sell-something-modal');
var backdropModal = document.getElementById('modal-backdrop')
var button = document.getElementById('sell-something-button');
var close = document.getElementById('modal-close');
var cancel = document.getElementById('modal-cancel');
var post = document.getElementById('modal-accept');
var update = document.getElementById('filter-update-button');


button.addEventListener("click", openmodal);
close.addEventListener("click", closemodal);
cancel.addEventListener("click", closemodal);
document.addEventListener("click", windowCloseModal);
post.addEventListener("click", submit);
update.addEventListener("click", filterPosts);

function windowCloseModal(event) {
  if (event.target == modal) {
    modal.style.display = "none";
    backdropModal.style.display = "none";
    clearModal();
  }
}

function openmodal(event) {
  backdropModal.style.display = "block";
  modal.style.display = "block";
}

function closemodal(event) {
  backdropModal.style.display = "none";
  modal.style.display = "none";
  clearModal();

}

function submit(event) {
  var itemDescription = document.getElementById('post-text-input').value;
  var photoUrl = document.getElementById('post-photo-input').value;
  var sellingPrice = document.getElementById('post-price-input').value;
  var city = document.getElementById('post-city-input').value;
  var condition = document.getElementsByName('post-condition');
  var cityFilter = document.getElementById('filter-city');
  var noCity = 0;
  var selectedCondition;
  for (var i = 0; i < condition.length; i++) {
    if (condition[i].checked) {
      selectedCondition = condition[i].value;
    }
  }


  if ((itemDescription === "") || (photoUrl === "") || (sellingPrice === "") || (city === "")) {
    alert("Not all fields have been completed, please fill out all fields and then submit.")
  }
  else {
    createPost(sellingPrice, city, selectedCondition, itemDescription, photoUrl);
    modal.style.display = "none";
    backdropModal.style.display = "none";
    function titleCase(city){
      city = city.toLowerCase();
      city = city.split(' ');
      for (var i = 0; i < city.length; i++) {
        city[i] = city[i].charAt(0).toUpperCase() + city[i].slice(1);
      }
      return city.join(' ');
    }


    for(var i = 0; i < cityFilter.options.length; i++){
      if((city === "") || (city.toUpperCase() === cityFilter.options[i].value.toUpperCase())){
        noCity = 1;
      }
    }

    if(noCity === 0){
      newCity = document.createElement('option');
      newCity.textContent = titleCase(city);
      cityFilter.appendChild(newCity);
      noCity = 0;
    }
    clearModal();
  }
  console.log("itemDescription:", itemDescription);
  console.log("photoUrl:", photoUrl);
  console.log("sellingPrice:", sellingPrice);
  console.log("city:", city);
  console.log("selectedCondition:", selectedCondition);
}

function clearModal() {
  document.getElementById('post-text-input').value = "";
  document.getElementById('post-photo-input').value = "";
  document.getElementById('post-price-input').value = "";
  document.getElementById('post-city-input').value = "";
  document.getElementById('post-condition-new').checked = true;
}


function filterPosts(event) {
  var textFilter = document.getElementById('filter-text').value;
  var minFilter = document.getElementById('filter-min-price').value;
  var maxFilter = document.getElementById('filter-max-price').value;
  var cityFilter = document.getElementById('filter-city');
  var conditionFilter = document.getElementsByName('filter-condition');
  var selectedConditionFilter = "";
  for (var i = 0; i < conditionFilter.length; i++) {
    if (conditionFilter[i].checked) {
      selectedConditionFilter = selectedConditionFilter + conditionFilter[i].value + " ";
    }
  }

  console.log("city filter:", cityFilter.options[1].value);
  cityFilter = cityFilter.options[cityFilter.selectedIndex].text;
  textFilter = textFilter.toUpperCase();
  var postTextFilter = document.getElementById('posts');
  var findPosts = postTextFilter.querySelectorAll('.post');
  var postBox = postTextFilter.getElementsByClassName('post')

  //FILTER TEXT DESCRIPTION
  filterTextDescription(postBox, postTextFilter, textFilter);

  //FILTER MIN AND MAX PRICE
  filterPrice(postTextFilter, minFilter, maxFilter, postBox);

  //FILTER CITY
  filterCity(postTextFilter, cityFilter, postBox);

  //FILTER CONDITON
  filterCondition(selectedConditionFilter, postBox, postTextFilter);

  console.log(document);
  console.log("text filter:", textFilter);
  console.log("min filter:", minFilter);
  console.log("max filter:", maxFilter);
  console.log("city filter:", cityFilter);
  console.log('Condition Filter:', selectedConditionFilter);
}

function filterTextDescription(postBox, postTextFilter, textFilter) {
  var postTextFilterDescription = postTextFilter.getElementsByTagName('a');
  var i = postBox.length;
  while (i--) {
    if (postTextFilterDescription[i].text.toUpperCase().indexOf(textFilter) > -1) {
      console.log("== Items:", postTextFilterDescription[i].text);
    } else {
      postBox[i].parentNode.removeChild(postBox[i]);
    }
  }
}

function filterPrice(postTextFilter, minFilter, maxFilter, postBox) {
  var postMinFilter = postTextFilter.querySelectorAll('.post');
  var i = postMinFilter.length;
  while (i--) {
    if (parseInt(postMinFilter[i].getAttribute('data-price')) >= minFilter) {

    } else {
      postBox[i].parentNode.removeChild(postBox[i]);
    }
    if (maxFilter !== "") {
      if (parseInt(postMinFilter[i].getAttribute('data-price')) <= maxFilter) {

      } else {
        postBox[i].parentNode.removeChild(postBox[i]);
      }
    }
  }
}


function filterCity(postTextFilter, cityFilter, postBox) {
  var postCityFilter = postTextFilter.querySelectorAll('.post');
  var i = postCityFilter.length;
  while (i--) {
    if (cityFilter !== 'Any') {
      if (cityFilter.toUpperCase() === postCityFilter[i].getAttribute('data-city').toUpperCase()) {

      } else {
        postBox[i].parentNode.removeChild(postBox[i]);
      }
    }
  }
}


function filterCondition(selectedConditionFilter, postBox, postTextFilter) {
  var postConditionFilter = postTextFilter.querySelectorAll('.post');
  selectedConditionFilter = selectedConditionFilter.toUpperCase();
  var i = postConditionFilter.length;
  while (i--) {
    if (selectedConditionFilter !== "") {
      if (selectedConditionFilter.indexOf(postConditionFilter[i].getAttribute('data-condition').toUpperCase()) > -1) {

      } else {
        postBox[i].parentNode.removeChild(postBox[i]);
      }
    }
  }
}



function addDivPost(sellingPrice, city, selectedCondition, postDiv){
  postDiv.classList.add('post');
  postDiv.setAttribute('data-price', sellingPrice);
  postDiv.setAttribute('data-city', city);
  postDiv.setAttribute('data-condition', selectedCondition);
}

function addDivPostContents(postDiv, postContentsDiv){
  postContentsDiv.classList.add('post-contents');
  postDiv.appendChild(postContentsDiv);
}

function addDivPostImageContainer(postImageContainerDiv, postContentsDiv){
  postImageContainerDiv.classList.add('post-image-container');
  postContentsDiv.appendChild(postImageContainerDiv);
}

function addImgPost(photoUrl, itemDescription, postImage, postImageContainerDiv){
  postImage.src = photoUrl;
  postImage.alt = itemDescription;
  postImageContainerDiv.appendChild(postImage);
}

function addDivPostInfoContainer(postInfoContainerDiv, postContentsDiv){
  postInfoContainerDiv.classList.add('post-info-container');
  postContentsDiv.appendChild(postInfoContainerDiv);
}

function addaHref(aHref, itemDescription, postInfoContainerDiv){
  aHref.setAttribute('href', '#');
  aHref.classList.add('post-title');
  aHref.textContent = itemDescription;
  postInfoContainerDiv.appendChild(aHref);
}

function addSpanPrice(postPriceSpan, sellingPrice, postInfoContainerDiv){
  postPriceSpan.classList.add('post-price');
  postPriceSpan.textContent = '$' + sellingPrice;
  postInfoContainerDiv.appendChild(postPriceSpan);
}

function addSpanCity(postCitySpan, city, postInfoContainerDiv){
  postCitySpan.classList.add('post-city');
  postCitySpan.textContent = '(' + city + ')';
  postInfoContainerDiv.appendChild(postCitySpan);
}

function createPost(sellingPrice, city, selectedCondition, itemDescription, photoUrl) {

  //CREATE DIV FOR POSTS
  var postDiv = document.createElement('div');
  addDivPost(sellingPrice, city, selectedCondition, postDiv);

  //CREATE DIV FOR POST CONTENTS
  var postContentsDiv = document.createElement('div');
  addDivPostContents(postDiv, postContentsDiv);

  //CREATE DIV FOR POST IMAGE CONTAINER
  var postImageContainerDiv = document.createElement('div');
  addDivPostImageContainer(postImageContainerDiv, postContentsDiv);

  //CREATE IMAGE FOR POSTS
  var postImage = document.createElement('img');
  addImgPost(photoUrl, itemDescription, postImage, postImageContainerDiv);

  //CREATE DIV FOR POST INFO CONTAINER
  var postInfoContainerDiv = document.createElement('div');
  addDivPostInfoContainer(postInfoContainerDiv, postContentsDiv);

  //CREATE a REFERENCE TO POSTS
  var aHref = document.createElement('a');
  addaHref(aHref, itemDescription, postInfoContainerDiv);

  //CREATE POST PRICE SPAN
  var postPriceSpan = document.createElement('span');
  addSpanPrice(postPriceSpan, sellingPrice, postInfoContainerDiv);

  //CREATE POST CITY SPAN
  var postCitySpan = document.createElement('span');
  addSpanCity(postCitySpan, city, postInfoContainerDiv);

  //ATTACHES NEW DIV TO THE POSTS SECTION IN HTML
  var postSection = document.getElementById('posts');
  postSection.appendChild(postDiv);
}
