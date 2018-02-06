// productFactory.js
(function() {
    'use strict';

    angular
        .module('afroApp')
        .factory('VideoFactory', videoFactory);

    /** @ngInject */
    function videoFactory($http, APPURL) {

        var apiHost = '/entertainment';

        var service = {
            apiHost: apiHost,
            getVideo: getVideo
        };

        return service;

        function getVideo(id) {

            return $http.get(APPURL + apiHost + '/get-video?video_id=' + id)
                .then(getSuccess)
                .catch(getError);

            function getSuccess(response) {
                return response.data;
            }

            function getError(error) {
                console.log('XHR Failed for items.\n' + angular.toJson(error.data, true));
            }
        }
    }
})();
