<p>
  <div ng-app="GaugeDashApp" ng-controller="GaugeDashController">
      <div id="gaugeMemory" dx-circular-gauge="gauge.memoryDash"></div>
      <div id="gaugeDisk" dx-circular-gauge="gauge.diskDash"></div>
      <div id="gaugeCPU" dx-circular-gauge="gauge.cpuDash"></div>
      <div id="gaugeNumProceses" dx-linear-gauge="gauge.numProcesesDash"></div>
      <div id="gaugeNumCores" dx-linear-gauge="gauge.numCoresDash"></div>
  </div>
</p>
