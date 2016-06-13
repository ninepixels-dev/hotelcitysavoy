'use strict';

ninepixelsAuth.$inject = ['api', '$cookies'];
function ninepixelsAuth(api, $cookies) {
    var self = this;

    api('users').fetch().then(function (user) {
        if (user) {
            self.user = user;
        }
    });

    this.getUser = function () {
        return self.user;
    };

    this.isLoggedIn = function () {
        return !!$cookies.getObject('user');
    };

}

angular.module('ninepixels', [
    'ngCookies',
    'ui.bootstrap',
    'angularFileUpload',
    'angular-medium-editor',
    'ninepixels.api',
    'ninepixels.login',
    'ninepixels.siteController',
    'ninepixels.editor',
    'ninepixels.uploader'
])
        .service('authentification', ninepixelsAuth);