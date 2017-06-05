angular.module('app.controllers')

.controller('ViewItemCtrl', function($scope, appSession, API, $http, $timeout, appAuth, $routeParams) {

  $scope.new_question = {

    question: "",
    answer: "none",
    status: 0
  }

  $scope.answer = {
    answer: "",
    status: 1
  }

  $scope.isInterested = false

  $scope.answerQuestion = function (question_id){
    $('#answerQuestionButton').addClass('disabled')
    $('#answerQuestionButton').html('Enviando...')
    var pos = $scope.questions.findIndex(function(x){return x.id == question_id})
    $http.patch(API + '/questions/' + question_id, $scope.answer)
    .then(function (res){
      $scope.questions[pos].answer = $scope.answer.answer
      $scope.questions[pos].status = 1
    }, function (res){
      console.log(res);
      //TODO: Handle error
    })
    .finally(function (res) {
      $scope.answerbox[pos] = false
      $('#answerQuestionButton').html('Preguntar')
      $('#answerQuestionButton').removeClass('disabled')
    })
  }

  $scope.sendQuestion = function (){
    $scope.new_question.item_id = $scope.item.id
    $('#sendQuestionButton').addClass('disabled')
    $('#sendQuestionButton').html('Enviando...')
    $http.post(API + '/questions', $scope.new_question)
    .then(function (res){
      $scope.questions.push(res.data.question)
    }, function (res){
      console.log(res);
      //TODO: Handle error
    })
    .finally(function (res) {
      $('#sendQuestionButton').html('Preguntar')
      $('#sendQuestionButton').removeClass('disabled')
    })
  }

  $scope.triggerAnswer = function (question_index) {
    $scope.answerbox[question_index] = true
  }

  $scope.interestsMe = function () {
    $('#interestButton').attr('disabled', true);
    $('#interestButtonText').html('Cargando...');
    $http.get(API + '/items/' + $scope.item.id + '/interested')
    .then(function (res){
      $('#interestButtonText').html('Ya está en tu lista');
    }, function (res){
      //TODO: Handle error
    })
  }

  $scope.triggerOffer = function () {
    $('#itemSelectModal').modal('show')
  }

  var checkInterest = function () {
    var index = $scope.session.user.interests.findIndex(function (x){return x.id == $routeParams.item_id})
    if (index >= 0)
      $scope.isInterested = true
  }

  var getQuestions = function (){
    $http.get(API + '/items/' + $routeParams.item_id + '/questions')
    .then(function (res){
      $scope.questions = res.data
      $scope.answerbox = new Array($scope.questions.length).fill(false)
    }, function (res){
      //TODO: Handle error
    })
  }

  var getItem = function () {
    $http.get(API + '/items/' + $routeParams.item_id)
    .then(function (res){
      $scope.item = res.data
      getQuestions()
    }, function (res){
      //TODO: Handle error
    })
  }

  //INIT
  getItem()
  checkInterest()

  //Init
});
