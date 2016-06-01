$(document).ready(function(){
    $('.update').on('click',function(){
      var id = $(this).attr("value");

      $.ajax({
        type: "POST",
        url: 'scripts/edit.php',
        data: {ID: id},
        success:function(data){
          console.log("success", data);
        }
      });
    });
});
