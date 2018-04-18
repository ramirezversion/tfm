var DemoApp = angular.module('DemoApp', ['dx']);

function damevalor($http){
  $http.get("/api/dashboard/memory")
       .then(function successCallback(response){
         console.log(response);
         return response.data;
       }, function errorCallback(response){
         console.log("Unable to perform get request");
         return;
       });
};

DemoApp.controller('DemoController', function DemoController($scope, $http) {

    $scope.gaugeOptions = {
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
            ranges: [
                { startValue: 0, endValue: 20, color: "#CE2029" },
                { startValue: 20, endValue: 50, color: "#FFD700" },
                { startValue: 50, endValue: 100, color: "#228B22" }
            ]
        },
        "export": {
            enabled: true
        },
        title: {
            text: "Memory ussage",
            font: { size: 28 }
        },
        value: Number(damevalor($http))
    };


});
