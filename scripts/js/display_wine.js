$(document).ready(function(){
  displayWineHome();
});

function displayWineHome(){
  $.ajax({
    type: 'GET',
    url: 'scripts/php/load_wine_home.php',
    dataType: 'html',
    success: function(response){
      $('.wine-feed-box').append(response);
    }
  });
}

setTimeout(fade_out, 2500);

function fade_out() {
  $(".alert").fadeOut();
}
