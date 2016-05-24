var api_data = {};
var wine = {}; //wine that we are going to send out to search for in the api call

$(document).ready(function(){
  $('#searchApi').on('submit', function(){
    searchApi();
  });


});

function wineApi(winery){
  var apiKey = "d92bbdc39ab169cf89da261bad304bed";
  console.log("Winery inside the WineAPI, ", winery);
  var wineSearch = winery.searchApi;
  $.ajax({
    type: 'GET',
    url: 'http://services.wine.com/api/beta2/service.svc/json/catalog?search='+wineSearch+'&size=10&apikey='+apiKey+'',
    success: displayResults
  });
}

function searchApi(){
  event.preventDefault();
  var winerySearch = $('#searchApi').serializeArray();
  $.each(winerySearch, function(index, element){
    wine[element.name] = element.value;
  });
  console.log("Wine ,", wine);
  wineApi(wine);
}

function displayResults(response){
  $('.wine-results').empty();
  var wineResults = response.Products.List;
  console.log("Wine Results: ", wineResults);
  for(var i = 0; i < wineResults.length; i++){
    $('.wine-results').append('<div class="animated fadeInRight underline"></div>');
    var $el = $('.wine-results').children().last();
    $el.append('<div>' +wineResults[i].Name+'</div>');

  }
}
