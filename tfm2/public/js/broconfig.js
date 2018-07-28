function getHostname($http, $scope){

  $http.get("/apibro/broconfig/fullsystem")
      .then(function successCallback(response){
        $scope.hostname = response.data.hostname;
        $scope.time = response.data.time;
        $scope.updateTime = response.data.updateTime;
        $scope.brostatus = response.data.brostatus;
      }, function errorCallback(response){
        console.log("Unable to perform get request");
      });

}


var BroApp = angular.module('BroApp', ['dx']);

BroApp.controller('BroController', function BroController($scope, $http) {

    var myvar = setInterval(function(){ getHostname($http, $scope) }, 1000);

});