angular.module('app.controllers')

.controller('InterestsCtrl', function($scope, appSession, API, $http, $timeout, appAuth) {

  $scope.parseStatus = function (status_id) {
    switch (status_id) {
      case 0:
        return 'Publicado'
        break
      case 1:
        return 'Oculto'
        break
      default:
        return 'Desconocido'
    }
  }

  $scope.viewItem = function (item_id) {
    history.pushState({}, null, '/#/items/' + item_id);
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
