function changeImg(event){
  var file = event.target.files[0];
  var reader = new FileReader();
  reader.onload = function(event) {
    var imageUrl = event.target.result;
    var img = document.createElement('img');
    img.src = imageUrl;
    img.style.height = '120px';
    img.style.width = '100px';
    var imageContainer = document.querySelector('#imgContainer');
    var oldimg = document.querySelector('#oldimg');
    var heightForm = document.querySelector('.list__form-add');
    heightForm.style.height = '670px';
    oldimg.style.display="none";
    imageContainer.innerHTML = '';
    imageContainer.appendChild(img);
 
  };
  reader.readAsDataURL(file);
}



