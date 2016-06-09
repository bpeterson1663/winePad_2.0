$(document).ready(function(){
  console.log('loaded');
  getCalculations();

});

function getCalculations(){
  console.log("inside function");
  $.ajax({
    type: 'GET',
    dataType: 'html',
    url: 'scripts/php/calculations.php',
    success: function(response){
      $('.dashboard').append(response);
      console.log("Response is ", response);
    }
  });
}
