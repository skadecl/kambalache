angular.module('app.services')

.factory('httpInterceptor', function(appAuth, API) {
  return {
    request: function(config) {
      var sessionToken = appAuth.getToken()

      config.params = config.params || {}

      if (config.url.indexOf(API) === 0 && sessionToken) {
        config.params.token = sessionToken
      }
      return config
    },

    response: function(res) {

      if (res.config.url.indexOf(API) === 0 && res.data.token) {
        appAuth.saveToken(res.data.token)
      }
      return res
    }
  }
})
