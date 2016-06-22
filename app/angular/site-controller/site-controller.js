'use strict';

npSiteController.$inject = ['$http', '$cookies', '$rootScope'];
function npSiteController($http, $cookies, $rootScope) {
    return {
        templateUrl: 'angular/views/toolbar.html',
        link: function (scope, elem, attr, ctrl) {
            scope.user = $cookies.getObject('user')[0];
            $rootScope.page = $cookies.getObject('page');

            scope.logout = function () {
                $http({
                    url: 'server/np-logout.php'
                }).then(function (response) {
                    if (response.data.logout) {
                        location.reload();
                    }
                });
            };
        }
    };
}

npPageController.$inject = ['$uibModal', '$scope', '$rootScope', 'api', '$timeout'];
function npPageController($uibModal, $scope, $rootScope, api, $timeout) {
    this.controlPage = function () {
        $scope.editMode = false;
        $scope.view = 'listpage';

        $uibModal.open({
            animation: true,
            size: 'lg',
            scope: $scope,
            windowClass: 'np-modal',
            controller: modalCtrl,
            backdrop: 'static',
            templateUrl: 'angular/views/page-dialog.html'
        });
    };

    this.editCurrentPage = function () {
        delete $scope.page;
        $scope.editMode = true;
        $scope.view = 'addpage';
        $scope.page = _.where($scope.pages, {page_id: $rootScope.page.page_id})[0];

        $uibModal.open({
            animation: true,
            size: 'lg',
            scope: $scope,
            windowClass: 'np-modal',
            controller: modalCtrl,
            backdrop: 'static',
            templateUrl: 'angular/views/page-dialog.html'
        });
    };

    function modalCtrl($uibModalInstance) {
        var uploading = false;

        $scope.uploadImage = false;

        $scope.validate = function (value) {
            $scope.page.page_name = value.replace(' ', '-').toLowerCase();
        };

        $scope.returnParent = function (parent) {
            return _.findWhere($scope.pages, {page_id: parent});
        };

        $.getJSON("templates/templates.json", function (json) {
            $scope.templates = json;
        });

        $scope.addPage = function () {
            $scope.view = 'addpage';
            $scope.editMode = false;

            $scope.page = {
                page_header: 1,
                page_navigation: 1,
                page_footer: 1,
                page_inNavigation: 1,
                page_active: 1
            };
        };

        $scope.undo = function () {
            delete $scope.page;
            $scope.view = 'listpage';
        };

        $scope.updatePage = function (page) {
            delete $scope.page;
            $scope.editMode = true;
            $scope.view = 'addpage';
            $scope.page = page;
        };

        $scope.deletePage = function (page) {
            api('pages').delete(page).then(function (response) {
                $scope.pages = _.without($scope.pages, page);
            });
        };

        $scope.save = function (page) {
            $scope.uploadImage = true;

            $scope.$on('upload-started', function () {
                uploading = true;
            });

            $scope.$on('upload-completed', function (event, args) {
                page.page_teaser = args;
                savePage(page);
            });

            $timeout(function () {
                if (!uploading) {
                    savePage(page);
                }
            }, 0);
        };

        $scope.cancel = function () {
            $uibModalInstance.close();
        };

        function savePage(page) {
            if (!$scope.editMode) {
                api('pages').add(page).then(function () {
                    location.reload();
                });
            } else {
                api('pages').update(page).then(function () {
                    location.reload();
                });
            }
        }
    }

    api('pages').fetch({page_delete: 0}).then(function (response) {
        $scope.pages = response;
    });
}

npUsersController.$inject = ['$uibModal', '$scope', 'api'];
function npUsersController($uibModal, $scope, api) {
    this.controlUsers = function () {
        $uibModal.open({
            animation: true,
            size: 'lg',
            scope: $scope,
            windowClass: 'np-modal',
            controller: modalCtrl,
            templateUrl: 'angular/views/users-dialog.html'
        });
    };

    function modalCtrl($uibModalInstance) {
        $scope.view = 'listuser';

        $scope.addUser = function () {
            $scope.view = 'adduser';
            $scope.editMode = false;
        };

        $scope.updateUser = function (user) {
            $scope.view = 'adduser';
            $scope.editMode = true;
            $scope.newuser = _.omit(user, 'user_password');
        };

        $scope.deleteUser = function (user) {
            api('users').delete(user).then(function (response) {
                $scope.users = _.without($scope.users, user);
            });
        };

        $scope.undo = function () {
            delete $scope.newuser;
            $scope.view = 'listuser';
        };

        $scope.save = function (newuser, dummy) {
            if (!$scope.editMode) {
                if (newuser.user_password !== dummy.user_password) {
                    return false;
                }
                api().createuser(newuser).then(function (response) {
                    if (response.register) {
                        $uibModalInstance.close();
                    }
                });

            } else {
                api('users').update(newuser).then(function (response) {
                    location.reload();
                });
            }
        };

        $scope.cancel = function () {
            $uibModalInstance.close();
        };
    }

    api('users').fetch({user_delete: 0}).then(function (response) {
        $scope.users = response;
    });

}

angular.module('ninepixels.siteController', [])
        .directive('npSiteController', npSiteController)
        .controller('npPageController', npPageController)
        .controller('npUsersController', npUsersController);