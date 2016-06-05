$(document).ready(function(){
  $('.confirm-delete').on('click', function(){
      var id = $(this).data('id');
      console.log("id is ", id);
      $.ajax({
          type: 'POST',
          url: 'scripts/delete.php',
          data: { ID: id },
          success: function(response) {
              console.log(response);
            }
      });
  });
});
