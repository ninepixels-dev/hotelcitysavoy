'use strict';

apiService.$inject = ['$q', '$http'];
function apiService($q, $http) {
    function isOK(response) {
        function isErrData(data) {
            return data && data._status && data._status === 'ERR';
        }

        return response.status >= 200 && response.status < 300 && !isErrData(response.data);
    }
    /**
     * Call $http once url is resolved
     */
    function http(config) {
        return $q.when(config.url).then(function (url) {
            config.url = url;
            return $http(config);
        }).then(function (response) {
            return isOK(response) ? response.data : $q.reject(response);
        });
    }

    function cleanParam(params) {
        if (params) {
            params = _.omit(params, '$$hashKey');
            return Object.keys(params).map(function (k) {
                return encodeURIComponent(k) + '=' + encodeURIComponent(params[k]);
            }).join('&');
        }
    }

    var api = function (table) {
        return {
            fetch: function (params) {
                return http({
                    url: 'server/api.php?method=GET&table=' + table,
                    method: 'POST',
                    data: cleanParam(params),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function (response) {
                    return response;
                });
            },
            add: function (params) {
                return http({
                    url: 'server/api.php?method=POST&table=' + table,
                    method: 'POST',
                    data: cleanParam(params),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function (response) {
                    return response;
                });
            },
            update: function (params) {
                return http({
                    url: 'server/api.php?method=PUT&table=' + table,
                    method: 'POST',
                    data: cleanParam(params),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function (response) {
                    return response;
                });
            },
            delete: function (params) {
                return http({
                    url: 'server/api.php?method=DELETE&table=' + table,
                    method: 'POST',
                    data: cleanParam(params),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function (response) {
                    return response;
                });
            },
            createuser: function (params) {
                return http({
                    method: 'POST',
                    url: 'server/np-register.php',
                    data: cleanParam(params),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function (response) {
                    return response;
                });
            }
        };
    };

    return api;
}

angular.module('ninepixels.api', [])
        .service('api', apiService);