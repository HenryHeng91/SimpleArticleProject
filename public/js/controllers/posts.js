//main.js
angular
.module('app')
.controller('postsCtrl', postsCtrl);

postsCtrl.$inject = ['$scope', '$http'];
function postsCtrl($scope, $http) {
  getAllProducts();

  function getAllProducts() {
      $http.get('http://localhost:8000/api/v1/posts').then(
          function(success) {
              debugger;

              if (success.statusText == "OK") {
                  $scope.posts = success.data.data ? success.data.data :[];

              } else {
                return [];
              }
          },
          function(error) {
            console.log(error);
            return [];
          });
    }
}


