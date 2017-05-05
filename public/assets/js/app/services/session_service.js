angular.module('app.services')

.service('appSession', function($window, $http, API, appAuth, $rootScope, $location) {

  var self = this;

  self.token = ''
  self.user = {}

  self.save = function() {
    if (self.user) {
      $window.localStorage['userData'] = $window.btoa(JSON.stringify(self.user))
    }
  };

  self.restore = function() {
    var lsData = $window.localStorage['userData'];
    var lsToken = $window.localStorage['token'];
    if (lsData && lsToken) {
      self.user = JSON.parse($window.atob(lsData));
      self.token = appAuth.getToken()
      // appNotify.enable();
    }
  };

  self.logIn = function(user_email, user_password) {
    // TODO: update models and login
    // TODO: handle errors

    return $http.post(API + '/auth/sign_in', {
      email: user_email,
      password: user_password
    }).then(function(res){
      self.user = res.data.userData
      self.save()
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

  self.updateUserData = function(userdata){
    self.user = userdata;
    self.save();
  }

  //--- INIT SESSION
  self.restore();
});
