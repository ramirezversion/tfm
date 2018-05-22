@extends('layouts.app')

@section('content')
    <h1>Log Tool</h1>

    <p class="lead">Here you can review the logs with the integrated ELK stack or you can open it in a new window clicking <a href="https://kibana.zero" target="_blank">here</a></p>

    <p>
      <iframe src="https://kibana.zero/app/kibana#/dashboard/Filebeat-syslog-dashboard?_g=(refreshInterval:(display:Off,pause:!f,value:0),time:(from:now-7d,mode:quick,to:now))&_a=(description:'Syslog%20dashboard%20from%20the%20Filebeat%20System%20module',filters:!(),fullScreenMode:!f,options:(darkTheme:!f,useMargins:!f),panels:!((gridData:(h:4,i:'1',w:8,x:0,y:1),id:Syslog-events-by-hostname,panelIndex:'1',type:visualization,version:'6.2.4'),(gridData:(h:4,i:'2',w:4,x:8,y:1),id:Syslog-hostnames-and-processes,panelIndex:'2',type:visualization,version:'6.2.4'),(columns:!(system.syslog.hostname,system.syslog.program,system.syslog.message),gridData:(h:7,i:'3',w:12,x:0,y:5),id:Syslog-system-logs,panelIndex:'3',sort:!('@timestamp',desc),type:search,version:'6.2.4'),(gridData:(h:1,i:'4',w:12,x:0,y:0),id:'327417e0-8462-11e7-bab8-bd2f0fb42c54',panelIndex:'4',type:visualization,version:'6.2.4')),query:(language:lucene,query:(query_string:(analyze_wildcard:!t,default_field:'*',query:'*'))),timeRestore:!f,title:'%5BFilebeat%20System%5D%20Syslog%20dashboard',viewMode:view)" frameborder="1" style="height: 100vh;width: 100%;"></iframe>
    </p>

@endsection
