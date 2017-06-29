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
    .when('/me/offers', {
      templateUrl: '/views/my_offers.html',
      controller: 'MyOffersCtrl'
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
    .when('/offers/:offer_id', {
      templateUrl: '/views/offers.html',
      controller: 'OffersCtrl'
    })
    .otherwise({
      redirectTo: '/404'
    });
});
