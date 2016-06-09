$(document).ready(function(){
  $('.delete').on('click', deleteWine);
  console.log("loaded");
  $('.update-wine').on('click', loadUpdateWineModal);

});

function loadUpdateWineModal(){
  $('#wineUpdateBody').empty();
  var id = $(this).data('id');
  console.log("Made it here");
  $.ajax({
      type: 'POST',
      url: 'scripts/php/load_update_form.php',
      data: { ID: id },
      success: function(response) {
          $('#updateWine').modal('show');
          $('#wineUpdateBody').append(response);
        }
  });
}

function deleteWine(){
  var id = $(this).data('id');
  $('#deleteWine').modal('show');

  $('.confirm-delete').on('click',function(){

    $.ajax({
        type: 'POST',
        url: 'scripts/php/delete.php',
        data: { ID: id },
        success: function(response) {
            $('.response').append(response);
            $('.wine-feed-box').empty();
            loadWine();
          }
    });
  });
}

setTimeout(fade_out, 2500);

function fade_out() {
  $(".alert").fadeOut();
}

function loadWine(){
  $.ajax({
    type: 'GET',
    url: 'scripts/php/load_wine_update_delete.php',
    dataType: 'html',
    success: function(response){
      $('.wine-feed-box').append(response);
    }
  });
}
