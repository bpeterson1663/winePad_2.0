$(document).ready(function(){
    displayWineHome();
    $('#showMenu').on('click', function(){
        $('#wineMenu').modal('show');
    });
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