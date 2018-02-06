var app = angular.module("afroApp", ['yaru22.angular-timeago']);
app.constant('APPURL', 'http://' + window.location.host);

app.run(['$http', function ($http) {
    console.log('run it');
}]);