//main.js
angular
.module('app')
.controller('usersTableCtrl', usersTableCtrl);

usersTableCtrl.$inject = ['$scope', '$timeout', '$http'];
function usersTableCtrl($scope, $timeout, $http) {
  $scope.users = getAllUsers();

  function getAllUsers() {
      $http.get('http://localhost:8000/api/v1/users').then(
          function(success) {
              debugger;

              if (success.status == "success") {


              } else {

              }
          },
          function(error) {
            debugger
          });
    }
}

//private function:
function convertHex(hex,opacity){
    hex = hex.replace('#','');
    r = parseInt(hex.substring(0,2), 16);
    g = parseInt(hex.substring(2,4), 16);
    b = parseInt(hex.substring(4,6), 16);

    result = 'rgba('+r+','+g+','+b+','+opacity/100+')';
    return result;
}

function random(min,max) {
    return Math.floor(Math.random()*(max-min+1)+min);
}

function random(min,max) {
    return Math.floor(Math.random()*(max-min+1)+min);
}



