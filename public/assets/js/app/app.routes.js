angular.module('app.routes', ['ngRoute'])

.config(function ($routeProvider, $locationProvider) {
  $routeProvider
    .when('/', {
      templateUrl: '/views/search.html',
      controller: 'SearchCtrl'
    })
    .when('/me/interests', {
      templateUrl: '/views/interests.html',
      controller: 'InterestsCtrl'
    })
    .when('/me/items', {
      templateUrl: '/views/my_items.html',
      controller: 'MyItemsCtrl'
    })
    .when('/me/items/new', {
      templateUrl: '/views/new_item.html',
      controller: 'NewItemCtrl'
    })
    .when('/items/:item_id', {
      templateUrl: '/views/items.html',
      controller: 'ViewItemCtrl'
    })
    .otherwise({
      redirectTo: '/404'
    });
});
