angular.module('app.services')

.service('appNotify', function($window, $http, API, appAuth,  $location, $timeout) {

  var self = this;

  self.notifs = {
    data: [],
    last: '',
    new: 0
  };

  self.active = false;

  self.enable = function(){
    self.active = true;
    getOldNotifications();
  };

  self.disable = function(){
    self.notifs.data = [];
    self.notifs.new = 0;
    self.notifs.last = '';
    self.active = false;
  };

  self.mark = function(id){
    // TODO: Handle better ? constant time
    for (var i = 0 ; i < self.notifs.data.length ; i++){
      if (self.notifs.data[i]._id == id) {
        $http.get(API + '/utils/notifications/mark/' + id)
        .then(function(res){
          self.notifs.data[i].seen = true;
          self.notifs.new--;
        });
        break;
      }
    }
  };

  refreshNotifications = function(){
    if (self.active){
      $http.get(API + '/utils/notifications/new')
      .then(function(res){
        //Make sure we're not inserting same notifs.
        if (res.data.length > 0 && res.data[0]._id != self.notifs.last){
          var tempNots = [];
          for (var i = 0 ; i < res.data.length ; i++){
            if (res.data[i]._id == self.notifs.last) break;

            tempNots.push(res.data[i]);
            self.notifs.new++;
          }
          self.notifs.data = tempNots.concat(self.notifs.data);
          self.notifs.last = res.data[0]._id;
        }
        if (self.notifs.new > 0) shakeBell();
      })
      .finally(function(){
        $timeout(refreshNotifications, 15000);
      });
    }
  };

  getOldNotifications = function(){
    $http.get(API + '/utils/notifications/old')
    .then(function(res){
      self.notifs.data = self.notifs.data.concat(res.data);
    })
    .finally(refreshNotifications);
  };

  shakeBell = function(){
    jQuery('.notificator').addClass('shake');
    setTimeout(function(){
      jQuery('.notificator').removeClass('shake');
    }, 500);
  };


});
