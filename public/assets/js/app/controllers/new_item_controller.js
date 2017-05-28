angular.module('app.controllers')

.controller('NewItemCtrl', function($scope, appSession, API, $http, $timeout, appAuth) {

  $scope.step = 1
  $scope.itemSaving = true
  $scope.newItem = {
    new: "1",
    use_time: 1,
    use_type: "1",
    category_id: "none",
    photos: [],
    settings_new: "0",
    settings_use_time: 1,
    settings_use_type: "3",
    views: 0,
    interested: 0,
    status: 0
  }

  var validate = function (step) {
    if (step == 0) return true

    else if (step == 1) {
      return true
    }
    else if (step == 2) {
      return true
    }
    else if (step == 3) {
      return true
    }
    else if (step == 4) {
      return true
    }

  }

  $scope.catclick = function (cat) {
    if (cat.parent == 0) {
      var parent_index = $scope.session.app.categories.findIndex(function (e){return e.id == cat.id})
      var children = $scope.session.app.categories.filter(function (element) {return element.parent == cat.id})
      var ticked_children = children.filter(function (element) {return element.ticked == true})

      if (ticked_children.length == children.length) {
        children.forEach(function (e){e.ticked = false})
      }
      else {
        var unticked = children.filter(function (element) {return (element.ticked == false || element.ticked == undefined)})
        unticked.forEach(function (e){e.ticked = true})
      }

      $scope.session.app.categories[parent_index].ticked = false
    }
  }


  $scope.nextStep = function () {
    if (validate($scope.step))
      $scope.step++
  }

  $scope.prevStep = function () {
    if ($scope.step == 1) return
    else $scope.step--
  }

  $scope.setStep = function (step) {
    if (validate(step))
      $scope.step = step
  }

  $scope.triggerUpload = function (){
    $('#fileInput').trigger('click')
  }

  $scope.saveImage = function () {
    $scope.newItem.photos.push($scope.myCroppedImage)
    $('#cropperModal').modal('hide')
  }

  $scope.deleteImage = function (imageIndex){
    $scope.newItem.photos.splice(imageIndex, 1)
  }

  $scope.createItem = function () {
    $('#saveItemModal').modal({backdrop: 'static', keyboard: false})
    $timeout(function () {
      $http.post(API + '/items', $scope.newItem)
      .then(function (res) {
        console.log(res);
        $scope.session.user.items.push(res.data.item)
      }, function (res) {
        //TODO: Handle error
      })
      .finally(function (res){
        $('#saveItemModal').modal('hide')
        history.pushState({}, null, '/#/me/products');
      })
    }, 200);
  }

  $scope.myImage='';
  $scope.myCroppedImage='';

  var handleFileSelect=function(evt) {
    var file=evt.currentTarget.files[0];
    var reader = new FileReader();
    reader.onload = function (evt) {
      $scope.$apply(function($scope){
        $scope.myImage=evt.target.result;
      });
    };
    reader.readAsDataURL(file);
    $('#cropperModal').modal('show')
  };

  angular.element(document.querySelector('#fileInput')).on('change',handleFileSelect);
  //Init
});
