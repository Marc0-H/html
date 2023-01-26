document.addEventListener("DOMContentLoaded", function() {
  var tag_selector = document.getElementById("tag_selector");
  var selected_tag = tag_selector.options[tag_selector.selectedIndex];
  var tag_color = selected_tag.dataset.color;
  document.getElementById("tag_color").value = tag_color;
});
