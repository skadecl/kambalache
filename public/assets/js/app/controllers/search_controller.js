angular.module('app.controllers')

.controller('SearchCtrl', function($scope, appSession, API, $http, $timeout, appAuth, $interval) {

  $scope.tab = 'normal'

  $scope.searchInput = ''
  $scope.resultsReady = false
  $scope.searchResult = []
  $scope.colors = ['tile-black', 'tile-primary', 'tile-blue', 'tile-red']
  $scope.selectedResults = []
  $scope.resultView = -1
  $scope.new_question = {

    question: "",
    answer: "none",
    status: 0
  }

  $scope.answer = {
    answer: "",
    status: 1
  }

  $scope.triggerSearch = function () {
    $('.results-tab').removeClass('hidden')
    $scope.resultsReady = false
    $scope.tab = 'results'
    do_search()
  }

  $scope.trimName = function (name) {
    if (name.length > 12){
      return name.substring(0, 11) + '...'
    }
    else {
      return name
    }
  }

  $scope.viewItem = function (item) {
    if ($scope.session.user.access) {
      var item_index = $scope.selectedResults.findIndex(function(elem){return elem.id == item.id})
      if (item_index < 0) {
        $scope.selectedResults.push(item)
        item_index = $scope.selectedResults.length - 1
        $scope.selectedResults[item_index].isInterested = false
        $scope.selectedResults[item_index].isOwn = true
        getItem(item_index)
        getQuestions(item_index)
        checkOwn(item_index)
        checkInterest(item_index)
      }
      viewTab(item_index)
    }
    else {
      $('#notLoggedModal').modal('show');
    }
  }

  var viewTab = function(index) {
    if ($scope.resultView > -1)
      $('.result-tab-view-' + $scope.resultView).parent().removeClass('active')

    $scope.resultView = index
    $timeout(function(){$('.result-tab-view-' + index).parent().addClass('active')}, 50)
    $scope.tab = 'itemView'
  }

  $scope.closeTab = function(index) {
    if (index == 0)
      $scope.selectedResults.shift()
    else if ($scope.selectedResults.length == 1)
      $scope.selectedResults = []
    else
      $scope.selectedResults.splice(1, index);

    if ($scope.selectedResults.length == 0)
      $scope.selectTab('results')
    else
      viewTab(index)
  }

  $scope.selectTab = function(tab) {
    $scope.tab = tab
    $('.result-tab-view-' + $scope.resultView).parent().removeClass('active')
    $scope.resultView = -1
  }

  var do_search = function () {
    $timeout(function () {
      $http.get(API + '/search/items/normal', {
        params: {
          search: $scope.searchInput
        }
      })
      .then(function (res) {
        $scope.resultsReady = true
        $scope.searchResult = res.data
      },function () {
        //TODO: Handle errors
      })
    }, 100);
  }

  $scope.answerQuestion = function (item_index, question_id){
    $('#' + item_index + '-answerQuestionButton').addClass('disabled')
    $('#' + item_index + '-answerQuestionButton').html('Enviando...')
    var pos = $scope.selectedResults[item_index].questions.findIndex(function(x){return x.id == question_id})
    $http.patch(API + '/questions/' + question_id, $scope.answer)
    .then(function (res){
      $scope.selectedResults[item_index].questions[pos].answer = $scope.answer.answer
      $scope.selectedResults[item_index].questions[pos].status = 1
    }, function (res){
      console.log(res);
      //TODO: Handle error
    })
    .finally(function (res) {
      $scope.selectedResults[item_index].answerbox[pos] = false
      $('#' + item_index + '-answerQuestionButton').html('Preguntar')
      $('#' + item_index + '-answerQuestionButton').removeClass('disabled')
      $('#' + item_index + '-answerTextArea').val('')
    })
  }


  $scope.sendQuestion = function (item_index){
    $scope.new_question.item_id = $scope.selectedResults[item_index].id
    $('#' + item_index + '-sendQuestionButton').addClass('disabled')
    $('#' + item_index + '-sendQuestionButton').html('Enviando...')
    $http.post(API + '/questions', $scope.new_question)
    .then(function (res){
      $scope.selectedResults[item_index].questions.push(res.data.question)
    }, function (res){
      console.log(res);
      //TODO: Handle error
    })
    .finally(function (res) {
      $('#' + item_index + '-sendQuestionButton').html('Preguntar')
      $('#' + item_index + '-sendQuestionButton').removeClass('disabled')
      $('#' + item_index + '-questionTextArea').val('')
    })
  }

  $scope.triggerAnswer = function (question_index) {
    $scope.selectedResults[item_index].answerbox[question_index] = true
  }

  $scope.interestsMe = function (item_index) {
    $('#' + item_index + '-interestButton').attr('disabled', true);
    $('#' + item_index + '-interestButtonText').html('Cargando...');
    $http.get(API + '/items/' + $scope.selectedResults[item_index].id + '/interested')
    .then(function (res){
      $('#' + item_index + '-interestButtonText').html('En tu lista');
      $scope.session.user.interests.push($scope.selectedResults[item_index].full_data)
    }, function (res){
      //TODO: Handle error
    })
  }

  $scope.triggerOffer = function () {
    $('#itemSelectModal').modal('show')
  }

  var checkInterest = function (item_index) {
    var index = $scope.session.user.interests.findIndex(function (x){return x.id == $scope.selectedResults[item_index].id})
    if (index >= 0)
      $scope.selectedResults[item_index].isInterested = true
  }

  var checkOwn = function (item_index) {
    var index = $scope.session.user.items.findIndex(function (x){return x.id == $scope.selectedResults[item_index].id})
    if (index >= 0)
      $scope.selectedResults[item_index].isOwn = true
    else
      $scope.selectedResults[item_index].isOwn = false
  }

  var getQuestions = function (item_index){
    $http.get(API + '/items/' + $scope.selectedResults[item_index].id + '/questions')
    .then(function (res){
      $scope.selectedResults[item_index].questions = res.data
      $scope.selectedResults[item_index].answerbox = new Array($scope.selectedResults[item_index].questions.length).fill(false)
    }, function (res){
      //TODO: Handle error
    })
  }

  var getItem = function (item_index) {
    $http.get(API + '/items/' + $scope.selectedResults[item_index].id)
    .then(function (res){
      $scope.selectedResults[item_index].full_data = res.data
    }, function (res){
      //TODO: Handle error
    })
  }




})

.directive("ngRandomClass", function () {
return {
    restrict: 'EA',
    replace: false,
    scope: {
        ngClasses: "=ngRandomClass"
    },
    link: function (scope, elem, attr) {
       //Add random background class to selected element
        elem.addClass(scope.ngClasses[Math.floor(Math.random() * (scope.ngClasses.length))]);
    }
}});
