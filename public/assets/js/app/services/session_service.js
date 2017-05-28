angular.module('app.services')

.service('appSession', function($window, $http, API, appAuth, $rootScope, $location, $timeout) {

  var self = this;

  self.token = ''
  self.user = {}
  self.app = {}

  self.save = function() {
    if (self.user) {
      $window.localStorage['userData'] = $window.btoa(JSON.stringify(self.user))
      $window.localStorage['appData'] = $window.btoa(JSON.stringify(self.app))
    }
  };

  self.restore = function() {
    var lsUserData = $window.localStorage['userData'];
    var lsAppData = $window.localStorage['appData'];
    var lsToken = $window.localStorage['token'];
    if (lsUserData && lsAppData && lsToken) {
      self.user = JSON.parse($window.atob(lsUserData));
      self.app =JSON.parse($window.atob(lsAppData));
      self.token = appAuth.getToken()
      // appNotify.enable();
    }
    self.loadAppData()
  };

  self.logIn = function(user_email, user_password) {
    // TODO: update models and login
    // TODO: handle errors

    return $http.post(API + '/auth/sign_in', {
      email: user_email,
      password: user_password
    }).then(function(res){
      self.user = res.data.userData
      self.loadAppData()
      // appNotify.enable();
    });
  };

  self.logOut = function() {
    $location.path('/');
    appAuth.removeToken();
    self.token = ''
    self.user = {}
    self.save()
    // appNotify.disable();
    // TODO: Handle better
  };

  self.isAuthed = function() {
    var sessionToken = appAuth.getToken();

    if (sessionToken) {
      var tokenParams = appAuth.parseToken(sessionToken);
      return Math.round(new Date().getTime() / 1000) <= tokenParams.exp;
    } else {
      return false;
    }
  };

  self.requireLogin = function(){
    if(!self.isAuthed()){
      location.href = '/login/'
      return false;
    }
    else {
      return true;
    }
  };

  self.formatCategories = function (categories){
    var parents = categories.filter(function (elem) {return elem.parent == 0})
    var ordered = []
    for (var p = 0 ; p < parents.length ; p++) {
      //parents[p].name = '<b>' + parents[p].name + '</b>'
      ordered.push(parents[p])
      var children = categories.filter(function (elem) {return elem.parent == parents[p].id})
      for (var c = 0 ; c < children.length ; c++) {
        children[c].name = '. . . .  ' + children[c].name
        ordered.push(children[c])
      }
    }
    return ordered
  }

  self.loadAppData = function(){
    $timeout(function(){
      //Load Categories
      $http.get(API + '/categories')
      .then(function (res){
        self.app.categories = self.formatCategories(res.data)
        self.save()
      }, function (){
        //TODO: Handle Error
      })
      .finally(function (){
        //Load user items if logged in
        if (self.isAuthed()){
          $http.get(API + '/items')
          .then(function (res) {
            self.user.items = res.data
            self.save()
          }, function () {
            //TODO: Handle error
          })
          .finally(function (){
            self.save()
          })
        }
      })
    }, 100)
  }


  //--- INIT SESSION
  self.restore();
});
