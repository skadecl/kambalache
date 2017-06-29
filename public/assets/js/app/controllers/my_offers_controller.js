angular.module('app.controllers')

.controller('MyOffersCtrl', function($scope, appSession, API, $http, $timeout, appAuth) {

  $scope.parseStatus = function (status_id) {
    switch (status_id) {
      case 0:
        return 'Enviada'
        break
      case 1:
        return 'Rechazada'
        break
      case 2:
        return 'Aceptada'
        break
      default:
        return 'Desconocido'
    }
  }

  $scope.viewOffer = function (offer_id) {
    history.pushState({}, null, '/#/offers/' + offer_id);
  }

})

.directive('tooltip', function(){
    return {
        restrict: 'A',
        link: function(scope, element, attrs){
            $(element).hover(function(){
                // on mouseenter
                $(element).tooltip('show');
            }, function(){
                // on mouseleave
                $(element).tooltip('hide');
            });
        }
    };
});
