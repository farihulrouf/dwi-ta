@extends('user.subindex')
@section('metadata')
       <meta property="og:type" content="website"/>
       <meta property="og:url" content="{{__('messages.site_name')}}"/>
       <meta property="og:title" content="{{__('messages.site_name')}}"/>
       <meta property="og:image" content="{{asset('public/upload/favicon1.ico')}}"/>
       <meta property="og:image:width" content="250px"/>
       <meta property="og:image:height" content="250px"/>
       <meta property="og:site_name" content="{{__('messages.site_name')}}"/>
       <meta property="og:description" content="{{__('messages.metadescweb')}}"/>
       <meta property="og:keyword" content="{{__('messages.metakeyboard')}}"/>
       <link rel="shortcut icon" href="{{asset('public/upload/favicon1.ico')}}">
      <meta name="viewport" content="width=device-width, initial-scale=1">
@stop
@section('content')
<div class="container a-con">
  <div class="pizzaro-about-features">
   <div class="feature-head">
    <h2 class="section-title">{{__('messages.termsandcon')}}</h2>
    <p> {{__('messages.aboutush')}}</p>
  </div>
</div>
</div>
<div class="container">
 <div class="terms-head">
   <h4>{{__('messages.term_h1')}}</h4>
   <ol>
     <li class="termls">{{__('messages.t1')}}</li>
     <li class="termls">{{__('messages.t2')}}</li>
     <li class="termls">{{__('messages.t3')}}</li>
     <li class="termls">{{__('messages.t4')}}</li>
     <li class="termls">{{__('messages.t5')}}</li>
     <li class="termls">{{__('messages.t6')}}</li>
 </ol>
</div>
</div>
@stop