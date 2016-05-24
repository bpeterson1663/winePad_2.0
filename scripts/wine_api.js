var api_data = {};

$(document).ready(function(){
  wineApi();
});

function wineApi(){
  var apiKey = "d92bbdc39ab169cf89da261bad304bed";
  var wineSearch = "Mondavi";
  $.ajax({
    type: 'GET',
    url: 'http://services.wine.com/api/beta2/service.svc/json/catalog?search='+wineSearch+'&size=10&apikey='+apiKey+'',
    success: function(response){
      console.log("Response from api, ", response);
    }
  });
}
