//main.js
angular
.module('app')
.controller('usersTableCtrl', usersTableCtrl);

usersTableCtrl.$inject = ['$scope', '$timeout', '$http'];
function usersTableCtrl($scope, $timeout, $http) {
  $scope.users = [];

  $scope.createUser = function(newUser) {
        var data = $.param({
            name: newUser.name,
            username: newUser.name,
            email: newUser.email,
            password: newUser.password,
            role: newUser.role
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        $http.post('http://localhost:8000/api/v1/users', data, config).then(
            function(success) {
                $scope.users.push(success.data);
                $('#userModal').modal('hide');
            },
            function(error) {
                console.log(error.data);
                alert(error.data.message);
            }
        )

    };

  $scope.deleteUser = function(user) {
        if(confirm('Are you sure?')){
            $http.delete('http://localhost:8000/api/v1/users/' + user.id).then(
                function(success) {
                    $scope.users.splice($scope.users.indexOf(user), 1);
                },
                function(error) {
                    console.log(error.data);
                    alert(error.data.message);
                }
            )
        }
    };

  getAllUsers();

  function getAllUsers() {
      $http.get('http://localhost:8000/api/v1/users').then(
          function(success) {
              $scope.users = success.data;
          },
          function(error) {
              console.log(error);
              $scope.users = [];
          }
      );
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



