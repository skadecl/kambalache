angular.module('app.routes', ['ngRoute'])

.config(function ($routeProvider, $locationProvider) {
  $routeProvider
    .when('/', {
      templateUrl: '/views/index.html'
    })
    .otherwise({
      redirectTo: '/404'
    });
});
