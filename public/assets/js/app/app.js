angular.module('app', ['app.services', 'app.routes', 'app.controllers'])
.constant('API', 'http://localhost:8000/api')
.config(function($httpProvider) {
  $httpProvider.interceptors.push('httpInterceptor');
}).config(['$qProvider', function ($qProvider) {
    $qProvider.errorOnUnhandledRejections(false);
}]);
