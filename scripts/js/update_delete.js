$(document).ready(function(){

  $('.delete').on('click', deleteWine);

  $('.update-wine').on('click', loadUpdateWineModal);

});

function loadUpdateWineModal(){
  $('#wineUpdateBody').empty();
  var id = $(this).data('id');
  console.log('id', id);
  $.ajax({
      type: 'POST',
      url: 'scripts/edit.php',
      data: { ID: id },
      success: function(response) {
          $('#updateWine').modal('show');
          console.log("Response is, ", response);
          $('#wineUpdateBody').append(response);
        }
  });
}

function deleteWine(){
  var id = $(this).data('id');
  $('#deleteWine').modal('show');

  $('.confirm-delete').on('click',function(){
    console.log("id is ", id);
    $.ajax({
        type: 'POST',
        url: 'scripts/php/delete.php',
        data: { ID: id },
        success: function(response) {
            $('.response').append(response);
            $('.wine-feed-box').empty();
            refreshWine();
          }
    });
  });
}

function refreshWine(){
  $.ajax({
    type: 'GET',
    url: 'scripts/php/refresh_wine_update.php',
    dataType: 'html',
    success: function(response){
      $('.wine-feed-box').append(response);
    }
  });
}
