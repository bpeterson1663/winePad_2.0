$(document).ready(function(){
  $('.delete').on('click', deleteWine);

  $('.update-wine').on('click', loadUpdateWineModal);

});

function loadUpdateWineModal(){
  var id = $(this).data('id');
  console.log('id', id);
  $.ajax({
      type: 'POST',
      url: 'scripts/edit.php',
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
    console.log("id is ", id);
    $.ajax({
        type: 'POST',
        url: 'scripts/delete.php',
        data: { ID: id },
        success: function(response) {
            $('.response').append(response);
          }
    });
  });
}
