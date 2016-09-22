myApp.controller("AddWineController", ["$scope", "$mdToast","$window", "$location", "$mdDialog","$http", "$mdMedia","$interval", "WineCellarService", function($scope, $mdToast, $window, $location, $mdDialog, $http, $mdMedia, $interval, WineCellarService){
  //store the factory object in wineCellar
    var wineCellar = WineCellarService;
    //Check if user is logged in
    wineCellar.checkUserLoggedIn();
    //get and display current winelist on users object
    wineCellar.getWineList();
    wineCellar.getLiquor();
    //search function being called on the searchApi partial
    $scope.search = function(ev, winery){
      var responseAPI = {};
      responseAPI.data = wineCellar.getWine(winery);//passes the name of winery into the searchWine funciton on the factory which goes out to the API
      console.log("response from api ", responseAPI);
       
        //opens up a dialog box displaying the search results
        var useFullScreen = ($mdMedia('sm') || $mdMedia('xs'))  && $scope.customFullscreen;
        $mdDialog.show({
          controller: DialogControllerSearch,
          templateUrl: 'dialogs/searchResults.html',
          parent: angular.element(document.body),
          targetEvent: ev,
          clickOutsideToClose:true,
          fullscreen: useFullScreen,
          scope: $scope,
          preserveScope: true
        })
        .then(function(answer) {
          $scope.status = 'You said the information was "' + answer + '".';
        }, function() {
          $scope.status = 'You cancelled the dialog.';
        });
      //set a variable on the scope that is equal to the wineCellar object to be displayed on the dom as the search result
        $scope.wineSelection = wineCellar;

    };
    //Addwine submit function from Search API Page
    $scope.addWine = function(addWine) {
      //abstract wine information into a variable called wine
      var wine = {
         name: addWine.Name,
         varietal: addWine.Varietal.Name,
         vintage: addWine.Vintage,
         appellation: addWine.Appellation.Name,
         region: addWine.Appellation.Region.Name,
         imgurl: addWine.Labels[0].Url,
         wineryinfo: addWine.wineryinfo,
         cost: addWine.cost,
         price: addWine.price,
         inventory: addWine.inventory,
         tastingnotes: addWine.tastingnotes,
         size: addWine.size
      };

      wineCellar.addWine(wine);//pass wine object into factory to be saved in database

  };
  //manually entering wine
  $scope.addWineManually = function(addWine) {
    wineCellar.manuallyAddWine(addWine);//when showAddConfirm is called in the searchResults partial it passes the wine information (wine) into the factory to update the winelist array on the user object
    $mdToast.show(
             $mdToast.simple()
                .textContent('Wine Successfully Added!')
                .hideDelay(3000).position('bottom left')
        );
  };
//Function for dialog search modal
  function DialogControllerSearch($scope, $mdDialog) {
      $scope.hide = function() {
        $mdDialog.hide();
      };
      $scope.cancel = function() {
        $mdDialog.cancel();
      };
      $scope.answer = function(answer) {
        $mdDialog.hide(answer);
      };
  }
}]);
