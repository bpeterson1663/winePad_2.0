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
  console.log("Results from API, ", wineResults);
  for(var i = 0; i < wineResults.length; i++){
    $('.wine-results').append('<form class="wine-result-individual" action="scripts/add_wine.php" method="POST"></form>');
    var $el = $('.wine-results').children().last();
    $el.append('<div class="form-group"><img src="'+wineResults[i].Labels[0].Url+'"/><label for="name">Name: </label><input class="form-control" type="text" name="name" value="'+wineResults[i].Name+'" /></div>');
    $el.append('<div class="form-group"><label for="varietal">Varietal: </label><input class="form-control" type="text" name="varietal" value="'+wineResults[i].Varietal.Name+'" /></div>');
    $el.append('<div class="form-group"><label for="vintage">Vintage: </label><input class="form-control" type="text" name="vintage" value="'+wineResults[i].Vintage+'" /></div>');
    $el.append('<div class="form-group"><label for="appellation">Appellation: </label><input class="form-control" type="text" name="appellation" value="'+wineResults[i].Appellation.Name+'" /></div>');
    $el.append('<div class="form-group"><label for="region">Region: </label><input class="form-control" type="text" name="region" value="'+wineResults[i].Appellation.Region.Name+'" /></div>');
    $el.append('<div class="form-group"><label for="imageurl">Image URL: </label><input class="form-control" type="text" name="imageurl" value="'+wineResults[i].Labels[0].Url+'" /></div>');
    $el.append('<div class="form-group"><label for="cost">Cost: </label><input class="form-control" type="number" name="cost" placeholder="$" /></div>');
    $el.append('<div class="form-group"><label for="price">Price: </label><input class="form-control" type="number" name="price" placeholder="$" /></div>');
    $el.append('<div class="form-group"><label for="size">Size: </label><input class="form-control" type="number" name="size" /></div>');
    $el.append('<div class="form-group"><a href="'+wineResults[i].Community.Reviews.Url+'">Tasting Notes: </a><input class="form-control" type="text" name="tastingnotes"/></div>');
    $el.append('<div class="form-group"><a href="'+wineResults[i].Community.Url+'">Winery Information: </a><input class="form-control" type="text" name="wineryinfo" /></div>');

    $el.append('<input type="submit" name="submit" value="Add Wine" class="add-wine btn btn-info">');

  }
}
