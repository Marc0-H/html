document.getElementById("thread-minimize-button").addEventListener("click", function(){
  var image = document.getElementById("thread-image");
  if (image.style.display == "none") {
    image.style.display = "block";
  } else {
    image.style.display = "none";
  }
});
