angular.module('app.controllers')

.controller('OffersCtrl', function($scope, appSession, API, $http, $timeout, appAuth, $routeParams) {

  $scope.isOwn = true



  var checkOwn = function () {
    var index = $scope.session.user.items.findIndex(function (x){return x.id == $routeParams.item_id})
    if (index >= 0)
      $scope.isOwn = true
    else
      $scope.isOwn = false
  }


  var getOffer = function () {
    $http.get(API + '/offers/' + $routeParams.offer_id)
    .then(function (res){
      $scope.offer = res.data
      getOwnerItem()
    }, function (res){
      //TODO: Handle error
    })
  }

  var getOwnerItem = function(){
    $http.get(API + '/items/' + $scope.offer.owner_item_id)
    .then(function (res){
      $scope.owner_item = res.data
    }, function (res){
      //TODO: Handle error
    })
  }

  var getOfferItems = function(){
    $http.get(API + '/offers/' + $routeParams.offer_id + '/items')
    .then(function (res){
      $scope.offer_items = res.data
    }, function (res){
      //TODO: Handle error
    })
  }

  //INIT
  getOffer()
  getOfferItems()
  // checkInterest()
  // checkOwn()

  //Init
});
