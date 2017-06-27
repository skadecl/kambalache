angular.module('app.controllers')

.controller('SearchCtrl', function($scope, appSession, API, $http, $timeout, appAuth, $interval) {

  $scope.tab = 'normal'

  $scope.searchInput = ''
  $scope.resultsReady = false
  $scope.searchResult = {}
  $scope.colors = ['tile-black', 'tile-primary', 'tile-blue', 'tile-red']

  $scope.triggerSearch = function () {
    $('.results-tab').removeClass('hidden')
    $scope.resultsReady = false
    $scope.tab = 'results'
    do_search()
  }

  $scope.viewItem = function (item_id) {
    if ($scope.session.user.access) {
      location.href = '/#/items/' + item_id;
    }
    else {
      $('#notLoggedModal').modal('show');
    }
  }

  var do_search = function () {
    $timeout(function () {
      $http.get(API + '/search/items/normal', {
        params: {
          search: $scope.searchInput
        }
      })
      .then(function (res) {
        $scope.resultsReady = true
        $scope.searchResult = res.data
      },function () {
        //TODO: Handle errors
      })
    }, 100);
  }
})

.directive("ngRandomClass", function () {
return {
    restrict: 'EA',
    replace: false,
    scope: {
        ngClasses: "=ngRandomClass"
    },
    link: function (scope, elem, attr) {
       //Add random background class to selected element
        elem.addClass(scope.ngClasses[Math.floor(Math.random() * (scope.ngClasses.length))]);
    }
}});
