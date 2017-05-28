angular.module('app.controllers')

.controller('MainCtrl', function($scope, appSession, API, $http, $timeout, appAuth) {

  $scope.session = appSession
  $scope.loginEmail = ''
  $scope.loginPassword = ''
  $scope.loginError = false
  $scope.loginLoading = false

  $scope.doLogin = function() {
    $scope.loginLoading = true
    $scope.loginError = false
    $scope.session.logIn($scope.loginEmail, $scope.loginPassword)
    .then(function (res) {
      // Login ok
      $scope.loginLoading = false
      $('.login-modal').modal('hide')
      $scope.loginEmail = ''
      $scope.loginPassword = ''
    }, function (res) {
      // Login fail
      $scope.loginLoading = false
      $scope.loginError = true
    })

  }

  //Init
});
