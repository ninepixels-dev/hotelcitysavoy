'use strict';

npLoginCtrl.$inject = ['$http', '$cookies', '$scope', 'api'];
function npLoginCtrl($http, $cookies, $scope, api) {

    $scope.login = function (login) {
        $http({
            url: 'server/np-login.php',
            method: 'POST',
            params: login
        }).then(function successCallback(response) {
            if (response.data.login) {
                api('users').fetch().then(function (user) {
                    if (user) {
                        $scope.user = user;
                        $cookies.putObject('user', user);
                        location.replace(location.href.substring(0, location.href.lastIndexOf("/") + 1));
                    }
                });
            } else {
                console.error('Login failed!', response.data);
            }
        });
    };
}

angular.module('ninepixels.login', [])
        .controller('npLoginCtrl', npLoginCtrl);