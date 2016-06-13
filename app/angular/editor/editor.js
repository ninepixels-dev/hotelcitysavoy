'use strict';

npEditor.$inject = [];
function npEditor() {
    return {
        scope: {itemID: '=item', pageID: '=page', identifier: '@', type: '@'},
        transclude: true,
        replace: true,
        templateUrl: 'angular/views/np-editor.html',
        link: function (scope, elem, attr, ctrl) {
            var floatingPanel = elem.find('.floating-panel');

            floatingPanel.appendTo(document.body);

            elem.on('mouseover', function () {
                var floatingPanelLeft;

                if ($(document).width() <= elem.outerWidth()) {
                    floatingPanelLeft = $(document).width() - floatingPanel.outerWidth() - 15;
                } else {
                    floatingPanelLeft = elem.offset().left + elem.outerWidth() - (floatingPanel.outerWidth() / 2);
                }

                floatingPanel.css({
                    position: 'absolute',
                    left: floatingPanelLeft,
                    top: elem.offset().top + ((elem.outerHeight() / 2) - (floatingPanel.outerHeight() / 2))
                }).addClass('active');
            });

            elem.on('mouseleave', function () {
                floatingPanel.removeClass('active');
            });
        }
    };
}

npEditorCtrl.$inject = ['$uibModal', '$scope', 'api', '$timeout', '$rootScope'];
function npEditorCtrl($uibModal, $scope, api, $timeout, $rootScope) {

    var type = $scope.type !== 'gallery' ? 'items' : 'gallery';

    $scope.uploadImage = false;

    this.add = function () {
        $scope.editMode = false;
        delete $scope.item;
        activateModal();
    };

    this.edit = function () {
        api('items').fetch({item_id: $scope.itemID}).then(function (item) {
            $scope.editMode = true;
            $scope.item = item[0];
            activateModal();
        });
    };

    function activateModal(data) {
        $uibModal.open({
            animation: true,
            size: 'lg',
            scope: $scope,
            windowClass: 'np-modal',
            controller: modalCtrl,
            backdrop: 'static',
            templateUrl: 'angular/views/editor-dialog.html'
        });
    }

    function modalCtrl($uibModalInstance) {
        var uploading = false;

        $scope.save = function (item) {
            if (!item) {
                item = {};
            }

            $scope.uploadImage = true;

            $scope.$on('upload-started', function () {
                uploading = true;
            });

            if (item.item_video) {
                var video_code = item.item_video.match(/youtube\.com.*(\?v=|\/embed\/)(.{11})/).pop();

                if (video_code.length === 11) {
                    item.item_video = video_code;
                } else {
                    delete item.item_video;
                }
            }

            if ($scope.type !== 'gallery') {
                $scope.$on('upload-completed', function (event, args) {
                    item.item_image = args;
                    saveFunc(item);
                });
            } else {
                $scope.$on('item-uploaded', function (event, args) {
                    item.gallery_image = args;
                    saveFunc(item);
                });

                $scope.$on('upload-completed', function () {
                    location.reload();
                });
            }

            $timeout(function () {
                if (!uploading) {
                    saveFunc(item);
                }
            }, 0);
        };

        $scope.cancel = function () {
            $uibModalInstance.close();
        };

        function saveFunc(item) {
            if (type === 'gallery' && item.item_video) {
                item.gallery_video = item.item_video;
                delete item.item_video;
            }

            if (!$scope.editMode) {
                type !== 'gallery' ? item.item_identifier = $scope.identifier : item.gallery_identifier = $scope.identifier;
                item.page_id = $scope.pageID ? $scope.pageID : $rootScope.page.page_id;

                api(type).add(item).then(function () {
                    if (type !== 'gallery' || !uploading) {
                        location.reload();
                    }
                });

            } else {
                type !== 'gallery' ? item.item_id = $scope.itemID : item.gallery_id = $scope.itemID;

                api(type).update(item).then(function () {
                    if (type !== 'gallery') {
                        location.reload();
                    }
                });
            }

            $scope.uploadImage = false;
            uploading = false;
        }

        $scope.mediumBindOptions = {
            toolbar: {
                buttons: ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'quote', 'unorderedlist', 'table', 'bold', 'italic', 'underline', 'anchor', 'removeFormat']
            },
            extensions: {
                table: new MediumEditorTable()
            },
            anchor: {
                placeholderText: 'Type a link',
                customClassOption: 'btn',
                customClassOptionText: 'Create Button'
            }
        };
    }
}

angular.module('ninepixels.editor', [])
        .directive('npEditor', npEditor)
        .controller('npEditorCtrl', npEditorCtrl);