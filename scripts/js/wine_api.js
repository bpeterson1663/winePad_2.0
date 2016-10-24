var api_data = {};
var wine = {}; //wine that we are going to send out to search for in the api call

$(document).ready(function(){
  console.log("loaded");
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
  console.log("Wine Object being searched ", wine.searchApi);
  $('#wineResultsLabel').html(" "+wine.searchApi);
  //send information collected to wineApiCall
  wineApiCall(wine);
}

function wineApiCall(winery){
  console.log("getting called");
  var apiKey = "d92bbdc39ab169cf89da261bad304bed";
  var wineSearch = winery.searchApi;
  $.ajax({
    type: 'GET',
    dataType: "jsonp",
    url: 'https://services.wine.com/api/beta2/service.svc/json/catalog?search='+wineSearch+'&size=3&apikey='+apiKey+'',
    success: displayResults
  });
}
//display the results upon success of the ajax call
function displayResults(response){
  console.log("response ", response);
  $('#searchResultsList').empty();
  var wineResults = response.Products.List;
  console.log("results ,", wineResults);
  for(var i = 0; i < wineResults.length; i++){
    $('#searchResultsList').append('<form class="wine-result-individual" method="POST"></form>');
    var $el = $('#searchResultsList').children().last();
    $el.append('<div class="form-group"><img src="'+wineResults[i].Labels[0].Url+'"/></br><label for="name">Name: </label><input class="form-control" type="text" name="name" value="'+wineResults[i].Name+'" /></div>');
    $el.append('<div class="form-group"><label for="varietal">Varietal: </label><input class="form-control" type="text" name="varietal" value="'+wineResults[i].Varietal.Name+'" /></div>');
    $el.append('<div class="form-group"><label for="vintage">Vintage: </label><input class="form-control" type="text" name="vintage" value="'+wineResults[i].Vintage+'" /></div>');
    $el.append('<div class="form-group"><label for="appellation">Appellation: </label><input class="form-control" type="text" name="appellation" value="'+wineResults[i].Appellation.Name+'" /></div>');
    $el.append('<div class="form-group"><label for="region">Region: </label><input class="form-control" type="text" name="region" value="'+wineResults[i].Appellation.Region.Name+'" /></div>');
    $el.append('<div class="form-group"><label for="imageurl">Image URL: </label><input class="form-control" type="text" name="imageurl" value="'+wineResults[i].Labels[0].Url+'" /></div>');
    $el.append('<div class="form-group"><label for="cost">Cost: </label><input class="form-control" type="number" name="cost" placeholder="$" step="any"/></div>');
    $el.append('<div class="form-group"><label for="price">Price: </label><input class="form-control" type="number" name="price" placeholder="$"step="any" /></div>');
    $el.append('<div class="form-group"><label for="inventory">Inventory: </label><input class="form-control" type="number" name="inventory" step="any"/></div>');
    $el.append('<div class="form-group"><label for="size">Size: </label><select class="form-control" placeholder="Size" type="number" name="size"><option value="">-</option><option value="187 mL">187 mL</option><option value="375 mL">375 mL</option><option value="750 mL">750 mL</option><option value="1.5 L">1.5 L</option><option value="3.0 L">3.0 L</option></select></div>');
    $el.append('<div class="form-group"><a href="'+wineResults[i].Community.Reviews.Url+'" target="_blank">Tasting Notes: </a><input class="form-control" type="text" name="tastingnotes"/></div>');
    $el.append('<div class="form-group"><a href="'+wineResults[i].Community.Url+'" target="_blank">Winery Information: </a><input class="form-control" type="text" name="wineryinfo" /></div>');

    $el.append('<input type="submit" name="submit" value="Add Wine" class="add-wine btn btn-danger">');

  }
}
