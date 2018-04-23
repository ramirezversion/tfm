var RouteMemory = {value:"memoryValue", route:"/api/dashboard/memory"};
var RouteDisk = {value:"diskValue", route:"/api/dashboard/disk"};
var RouteCPU = {value:"cpuValue", route:"/api/dashboard/cpu"};
var RouteNumProceses = {value:"numProcValue", route:"/api/dashboard/numproc"};
var RouteKernelVersion = {value:"kernelVersion", route:"/api/dashboard/kernel"};
var RouteNumCores = {value:"numCores", route:"/api/dashboard/numcores"};

var apiRoutes = [
  RouteMemory,
  RouteDisk,
  RouteCPU,
  RouteNumProceses,
  RouteKernelVersion,
  RouteNumCores
];


function asyncFor($http, $scope){

  for (var i = 0; i < apiRoutes.length; i++) {
    getApiValues($http, i);
  }

  $scope.memoryValue = apiRoutes[0].data;
  $scope.diskValue = apiRoutes[1].data;
  $scope.cpuValue = apiRoutes[2].data;
  $scope.numProceses = apiRoutes[3].data;
  $scope.kernelVersion = apiRoutes[4].data;
  $scope.numCores = apiRoutes[5].data;

}


function getApiValues($http, i){

  var callApiRoute = String(apiRoutes[i].route);
  var response;

  $http.get(callApiRoute)
      .then(function successCallback(response){
        apiRoutes[i].data = response.data;
      }, function errorCallback(response){
        console.log("Unable to perform get request");
      });

};



function getFullApiValues($http, $scope){

  //var dashboard = {};
  //var response;

  $http.get("/api/dashboard/full")
      .then(function successCallback(response){
        console.log(response.data);
        //dashboard = response.data;
        $scope.memoryValue = response.data.memorypercent;
        $scope.diskValue = response.data.disk;
        $scope.cpuValue = response.data.cpu;
        $scope.uptime = response.data.uptime;
        $scope.numProceses = response.data.numproc;
        $scope.kernelVersion = response.data.kernel;
        $scope.numCores = response.data.numcores;
      }, function errorCallback(response){
        console.log("Unable to perform get request");
      });

}



var GaugeDashApp = angular.module('GaugeDashApp', ['dx']);

GaugeDashApp.controller('GaugeDashController', function GaugeDashController($scope, $http) {

    //var myvar = setInterval(function(){ asyncFor($http, $scope) }, 1000);
    var myvar = setInterval(function(){ getFullApiValues($http, $scope) }, 1000);

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
