var DemoApp = angular.module('DemoApp', ['dx']);

function dameValor($http, $scope, urlApi){
   $http.get(urlApi)
       .then(function successCallback(response){
         //console.log(response);
         //console.log(response.data);
         $scope.value = response.data;
       }, function errorCallback(response){
         console.log("Unable to perform get request");
       });
};

var app = DemoApp.controller('DemoController', function DemoController($scope, $http) {

    $scope.gaugeOptions = {
        bindingOptions: {
          value: "value",
        },
        scale: {
            startValue: 0,
            endValue: 100,
            tickInterval: 10,
            label: {
                customizeText: function (arg) {
                    return arg.valueText + " %";
                }
            }
        },
        rangeContainer: {
          palette: "pastel",
            ranges: [
                { startValue: 0, endValue: 65 },
                { startValue: 65, endValue: 85 },
                { startValue: 85, endValue: 100 }
            ]
        },
        "export": {
            enabled: true
        },
        // title: {
        //     text: "Memory ussage",
        //     font: { size: 28 }
        // },
        value: $scope.value,
        onInitialized: function() {
          var myvar = setInterval(function(){ dameValor($http, $scope, "/api/dashboard/memory") }, 1000);
        }

    };

});
