var RouteMemory = {value:"memoryValue", route:"/api/dashboard/memory"};
var RouteDisk = {value:"diskValue", route:"/api/dashboard/disk"};

var apiRoutes = [
  RouteMemory,
  RouteDisk
];


function getApiValues($http, $scope){

  for (var i = 0; i < apiRoutes.length; i++) {
     console.log(i);
  }

   $http.get("/api/dashboard/memory")
       .then(function successCallback(response){
         //console.log(response);
         //console.log(response.data);
         $scope.memoryValue = response.data;
       }, function errorCallback(response){
         console.log("Unable to perform get request");
       });

};

var GaugeDashApp = angular.module('GaugeDashApp', ['dx']);

GaugeDashApp.controller('GaugeDashController', function GaugeDashController($scope, $http) {

    var myvar = setInterval(function(){ getApiValues($http, $scope) }, 1000);

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

    //$scope.gaugeOptions = {
    $scope.gauge = {
      memoryDash: {
        bindingOptions: bindingOptionsMemory,
        scale: scale,
        rangeContainer: rangeContainer,
        "export": {
            enabled: true
        },
        title: {
           text: "Memory ussage",
           font: { size: 20 }
        },
        value: $scope.memoryValue,
        // onInitialized: function() {
        //   var myvar = setInterval(function(){ $scope.value = dameValor($http, $scope, "/api/dashboard/memory") }, 1000);
        // }
      },

      diskDash: {
        bindingOptions: bindingOptionsDisk,
        scale: scale,
        rangeContainer: rangeContainer,
        "export": {
            enabled: true
        },
        title: {
           text: "Disk ussage",
           font: { size: 20 }
        },
        value: $scope.diskValue,
        // onInitialized: function() {
        //   var myvar2 = setInterval(function(){ $scope.value2 = dameValor($http, $scope, "/api/dashboard/disk") }, 1000);
        // }
      }
    };

});
