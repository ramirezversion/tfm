function getSystemConfig($http, $scope){

  $http.get("/apibro/broconfig/fullsystem")
      .then(function successCallback(response){
        $scope.hostname = response.data.hostname;
        $scope.time = response.data.time;
        $scope.updateTime = response.data.updateTime;
        $scope.pcapsize = response.data.pcapsize;
        $scope.pcapsizeused = response.data.pcapsizeused;
        $scope.fileextractedsize = response.data.fileextractedsize;
        $scope.fileextractedsizeused = response.data.fileextractedsizeused;
        $scope.networks = response.data.networks;
        $scope.brostatus = response.data.brostatus;
      }, function errorCallback(response){
        console.log("Unable to perform get request");
      });

}


function getSystemTime($http, $scope){

  $http.get("/apibro/broconfig/time")
      .then(function successCallback(response){
        $scope.time = response.data.time;
      }, function errorCallback(response){
        console.log("Unable to perform get request");
      });

}


var BroApp = angular.module('BroApp', ['dx']);

BroApp.controller('BroController', function BroController($scope, $http) {

    getSystemConfig($http, $scope);
    var myvar = setInterval(function(){ getSystemTime($http, $scope) }, 1000);
    var myvar2 = setInterval(function(){ getSystemConfig($http, $scope) }, 10000);

});
