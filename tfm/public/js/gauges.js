var RouteMemory = {value:"memoryValue", route:"/api/dashboard/memory"};
var RouteDisk = {value:"diskValue", route:"/api/dashboard/disk"};
var RouteCPU = {value:"cpuValue", route:"/api/dashboard/cpu"};

var apiRoutes = [
  RouteMemory,
  RouteDisk
];


function followTheFor($http, $scope){

  for (var i = 0; i < apiRoutes.length; i++) {
    getApiValues($http, $scope, i);
  }

  $scope.memoryValue = apiRoutes[0].data;
  $scope.diskValue = apiRoutes[1].data;
  $scope.cpuValue = apiRoutes[2].data;

}


function getApiValues($http, $scope, i){

    $http.get(apiRoutes[i].route)
        .then(function successCallback(responseMemory){
          console.log(i);
          console.log(response.data);
          //$scope.memoryValue = response.data;
          apiRoutes[i].data = responseMemory.data;
        }, function errorCallback(responseMemory){
          console.log("Unable to perform get request");
        });


     // $http.get("/api/dashboard/memory")
     //     .then(function successCallback(responseMemory){
     //       console.log(responseMemory);
     //       //console.log(response.data);
     //       //$scope.memoryValue = response.data;
     //       $scope.memoryValue = responseMemory.data;
     //     }, function errorCallback(responseMemory){
     //       console.log("Unable to perform get request");
     //     });
     //
     // $http.get("/api/dashboard/disk")
     //     .then(function successCallback(responseDisk){
     //       console.log(responseDisk);
     //       //console.log(response.data);
     //       //$scope.memoryValue = response.data;
     //       $scope.diskValue = responseDisk.data;
     //     }, function errorCallback(responseDisk){
     //       console.log("Unable to perform get request");
     //     });
     //
     // $http.get("/api/dashboard/cpu")
     //     .then(function successCallback(responseCPU){
     //       console.log(responseCPU);
     //       //console.log(response.data);
     //       //$scope.memoryValue = response.data;
     //       $scope.cpuValue = responseCPU.data;
     //     }, function errorCallback(responseCPU){
     //       console.log("Unable to perform get request");
     //     });

};

var GaugeDashApp = angular.module('GaugeDashApp', ['dx']);

GaugeDashApp.controller('GaugeDashController', function GaugeDashController($scope, $http) {

    //var myvar = setInterval(function(){ getApiValues($http, $scope) }, 1000);

    var myvar = setInterval(function(){ followTheFor($http, $scope) }, 1000);

    var scale = {
      startValue: 0,
      endValue: 100,
      tickInterval: 10,
      label: {
          customizeText: function (arg) {
              return arg.valueText + " %";
          }
      }
    };

    var rangeContainer= {
      palette: "pastel",
        ranges: [
            { startValue: 0, endValue: 65 },
            { startValue: 65, endValue: 85 },
            { startValue: 85, endValue: 100 }
        ]
    };

    var bindingOptionsMemory = {
      value: "memoryValue",
    };

    var bindingOptionsDisk = {
      value: "diskValue",
    };

    var bindingOptionsCPU = {
      value: "cpuValue",
    };

    $scope.gauge = {
      memoryDash: {
        bindingOptions: bindingOptionsMemory,
        scale: scale,
        rangeContainer: rangeContainer,
        "export": {
            enabled: false
        },
        title: {
           text: "Memory usage",
        },
        value: $scope.memoryValue,
      },

      diskDash: {
        bindingOptions: bindingOptionsDisk,
        scale: scale,
        rangeContainer: rangeContainer,
        "export": {
            enabled: false
        },
        title: {
           text: "Disk usage",
        },
        value: $scope.diskValue,
      },

      cpuDash: {
        bindingOptions: bindingOptionsCPU,
        scale: scale,
        rangeContainer: rangeContainer,
        "export": {
            enabled: false
        },
        title: {
           text: "CPU usage",
        },
        value: $scope.cpuValue,
      }

    };

});