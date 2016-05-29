var api_data = {};
var wine = {}; //wine that we are going to send out to search for in the api call

$(document).ready(function(){
  $('#searchApi').on('submit', function(){
    searchApi();
  });

});
//create function that will get information from user to search for winery
function searchApi(){
  event.preventDefault();
  var winerySearch = $('#searchApi').serializeArray();
  $.each(winerySearch, function(index, element){
    wine[element.name] = element.value;
  });
  //send information collected to wineApiCall
  wineApiCall(wine);
}

function wineApiCall(winery){
  var apiKey = "d92bbdc39ab169cf89da261bad304bed";
  var wineSearch = winery.searchApi;
  $.ajax({
    type: 'GET',
    url: 'http://services.wine.com/api/beta2/service.svc/json/catalog?search='+wineSearch+'&size=10&apikey='+apiKey+'',
    success: displayResults
  });
}
//display the results upon success of the ajax call
function displayResults(response){
  $('.wine-results').empty();
  var wineResults = response.Products.List;

  for(var i = 0; i < wineResults.length; i++){
    $('.wine-results').append('<div class="animated fadeInRight underline"></div>');
    var $el = $('.wine-results').children().last();
    $el.append('<div>' +wineResults[i].Name+'</div>');
  }
}
