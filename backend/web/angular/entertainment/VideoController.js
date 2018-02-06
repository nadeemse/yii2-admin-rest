(function() {
    'use strict';

    angular
        .module('afroApp')
        .controller('VideoController', videoController);

    /** @ngInject */
    function videoController($timeout, $filter, $window, VideoFactory) {
        var vm = this;

        vm.videos = [];
        vm.type = 'video';

        vm.isLoading = false;

        function initForm() {

            vm.videoForm = {
                id: null,
                videoId: null,
                title: null,
                kind: null,
                description: null,
                image: null
            };

        }

        initForm();

        vm.onSubmit = function () {

            vm.videos.push(vm.videoForm);
            $('#addVideo').modal('hide');
        };

        vm.addVideo = function () {
            console.log('es');
            initForm();
            $('#addVideo').modal({
                backdrop: false
            });
        };

        vm.getVideo = function() {

            if(vm.videoForm.id !== null) {

                vm.isLoading = true;
                VideoFactory.getVideo(vm.videoForm.id).then(function(response) {

                    if( response ) {
                        vm.videoForm = response;
                    }
                    vm.isLoading = false;
                });

            } else {
                vm.alert('video id', 'Please provide valid video ID', 'error');
            }



        };

        vm.removeVideo = function(item) {
            vm.videos.splice( vm.videos.indexOf(item) , 1);
        };

        vm.editVideo = function(item) {
            vm.videoForm = item;
            $('#addVideo').modal();
        };

        vm.alert = function (title, text, type) {

            swal({
                title: title,
                text: text,
                type: type
            });

        };

        vm.initVideos = function () {
            $timeout(function () {

                vm.type = $window.dataType;

                console.log($window.dataType);

                angular.forEach($window.videos, function (item, key) {
                    vm.videos.push(item);
                });
            }, 100);
        };

        vm.initVideos();


    }
})();