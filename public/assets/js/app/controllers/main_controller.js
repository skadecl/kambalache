angular.module('app.controllers')

.controller('MainCtrl', function($scope, appSession, API, $http, $timeout, appAuth) {

  $scope.session = appSession;
  
});
