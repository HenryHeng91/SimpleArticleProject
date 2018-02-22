//main.js
angular
.module('app', ['ngFileUpload'])
.controller('postsCtrl', postsCtrl);

postsCtrl.$inject = ['$scope', '$http', 'Upload', '$timeout'];
function postsCtrl($scope, $http, Upload, $timeout) {
  getAllProducts();

  function getAllProducts() {
      $http.get('http://localhost:8000/api/v1/posts').then(
          function(success) {
              if (success.statusText == "OK") {
                  $scope.posts = success.data.data ? success.data.data :[];
              } else {
                return [];
              }
          },
          function(error) {
            console.log(error);
            return [];
          }
      );
    }

    $scope.uploadPic = function(file) {
      debugger;
        file.upload = Upload.upload({
            url: 'http://localhost:8000/api/v1/posts',
            data: {
                title: $scope.newpost.title,
                body: $scope.newpost.body,
                file: file
            }
        });

        file.upload.then(function (response) {
            debugger;
            $timeout(function () {
                file.result = response.data;
                $scope.posts.push(response.data)
                $scope.picFile = null;
                $('#postModal').modal('hide');
            });
        }, function (response) {
            debugger;
            if (response.status > 0){
                $scope.errorMsg = response.status + ': ' + response.data;
                alert(response.data.error)
            }

        }, function (evt) {
            // Math.min is to fix IE which reports 200% sometimes
            file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
        });
    }
}


