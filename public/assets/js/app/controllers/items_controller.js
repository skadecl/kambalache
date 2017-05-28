angular.module('app.controllers')

.controller('ViewItemCtrl', function($scope, appSession, API, $http, $timeout, appAuth, $routeParams) {

  var getItem = function () {
    $http.get(API + '/items/' + $routeParams.item_id)
    .then(function (res){
      $scope.item = res.data
    }, function (res){
      //TODO: Handle error
    })
  }

  //INIT
  getItem()

  //Init
});
