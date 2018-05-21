@extends('layouts.app')

@section('content')
    <h1>Log Tool</h1>

    <p class="lead">Here you have the ELK log stack.</p>

    <p>
      <iframe src="http://kibana.zero/app/kibana#/dashboard/5517a150-f9ce-11e6-8115-a7c18106d86a?_g=(refreshInterval:('$$hashKey':'object:287',display:'5%20seconds',pause:!f,section:1,value:5000),time:(from:now-7d,mode:quick,to:now))&_a=(description:'SSH%20dashboard%20for%20the%20System%20module%20in%20Filebeat',filters:!(),fullScreenMode:!f,options:(darkTheme:!f,useMargins:!f),panels:!((gridData:(h:3,i:'1',w:12,x:0,y:4),id:d16bb400-f9cc-11e6-8115-a7c18106d86a,panelIndex:'1',type:visualization,version:'6.2.4'),(gridData:(h:3,i:'2',w:12,x:0,y:1),id:'78b74f30-f9cd-11e6-8115-a7c18106d86a',panelIndex:'2',type:visualization,version:'6.2.4'),(gridData:(h:4,i:'3',w:6,x:0,y:7),id:'341ffe70-f9ce-11e6-8115-a7c18106d86a',panelIndex:'3',type:visualization,version:'6.2.4'),(embeddableConfig:(mapBounds:(bottom_right:(lat:10.31491928581316,lon:74.53125),top_left:(lat:60.50052541051131,lon:-27.94921875)),mapCenter:!(39.774769485295465,23.203125),mapCollar:(bottom_right:(lat:-14.777884999999998,lon:125.771485),top_left:(lat:85.593335,lon:-79.189455),zoom:3),mapZoom:3),gridData:(h:4,i:'4',w:6,x:6,y:7),id:'3cec3eb0-f9d3-11e6-8a3e-2b904044ea1d',panelIndex:'4',type:visualization,version:'6.2.4'),(columns:!(system.auth.ssh.event,system.auth.ssh.method,system.auth.user,system.auth.ssh.ip,system.auth.ssh.geoip.country_iso_code),gridData:(h:3,i:'5',w:12,x:0,y:11),id:'62439dc0-f9c9-11e6-a747-6121780e0414',panelIndex:'5',sort:!('@timestamp',desc),type:search,version:'6.2.4'),(gridData:(h:1,i:'6',w:12,x:0,y:0),id:'327417e0-8462-11e7-bab8-bd2f0fb42c54',panelIndex:'6',type:visualization,version:'6.2.4')),query:(language:lucene,query:(query_string:(analyze_wildcard:!t,default_field:'*',query:'*'))),timeRestore:!f,title:'%5BFilebeat%20System%5D%20SSH%20login%20attempts',viewMode:view)" frameborder="1" style="height: 150vh;width: 100%;"></iframe>
    </p>

@endsection
