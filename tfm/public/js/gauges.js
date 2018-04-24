function getFullApiValues($http, $scope){

  $http.get("/api/dashboard/full")
      .then(function successCallback(response){
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

    var scaleLinear = {
      startValue: 0,
      endValue: 250,
      tickInterval: 50,
      label: {
        customizeText: function (arg) {
            return arg.valueText;
        }
      }
    };

    var scaleCores = {
      startValue: 0,
      endValue: 8,
      tickInterval: 1,
      label: {
        customizeText: function (arg) {
            return arg.valueText;
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

    var rangeContainerCores= {
      palette: "ocean",
      ranges: [
          { startValue: 0, endValue: 1 },
          { startValue: 1, endValue: 2 },
          { startValue: 2, endValue: 8 }
      ]
    };

    var rangeContainerLinear= {
      palette: "pastel",
        ranges: [
            { startValue: 0, endValue: 180 },
            { startValue: 180, endValue: 220 },
            { startValue: 220, endValue: 250 }
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

    var bindingOptionsNumProceses = {
      value: "numProceses",
    };

    var bindingOptionsNumCores = {
      value: "numCores",
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
      },

      numProcesesDash: {
        bindingOptions: bindingOptionsNumProceses,
        scale: scaleLinear,
        rangeContainer: rangeContainerLinear,
        "export": {
           enabled: false
        },
        title: {
           text: "Number of running proceses",
        },
        tooltip: {
          enabled: true,
          customizeTooltip: function (arg) {
              return {
                  text: arg.valueText,
              };
          }
        },
        valueIndicator: {
           type: "triangleMarker",
           color: "#f05b41"
        },
        value: $scope.numCores,
      },

      numCoresDash: {
        bindingOptions: bindingOptionsNumCores,
        scale: scaleCores,
        rangeContainer: rangeContainerCores,
        "export": {
           enabled: false
        },
        title: {
           text: "Number of cores",
        },
        tooltip: {
          enabled: true,
          customizeTooltip: function (arg) {
              return {
                  text: arg.valueText,
              };
          }
        },
        valueIndicator: {
           type: "triangleMarker",
           color: "#f05b41"
        },
        value: $scope.numProceses,
      }

    };

});
