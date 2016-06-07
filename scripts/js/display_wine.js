$(document).ready(function(){
  console.log("Display_Wine.js Loaded");
  displayWineHome();
});

function displayWineHome(){
  $.ajax({
    type: 'GET',
    url: 'scripts/php/show_wine.php',
    dataType: 'html',
    success: function(response){
      $('.wine-feed-box').append(response);
    }
  });
}
