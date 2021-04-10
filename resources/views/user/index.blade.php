   <!DOCTYPE html>
<html>
   <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      
      <title>{{__('messages.site_name')}}</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
       @if(Session::get("is_rtl")==0)
         <link rel="stylesheet" type="text/css" href="{{asset('design/css/style.css?v=1414145')}}">
         @else
         <link rel="stylesheet" type="text/css" href="{{asset('design/css/rtl.css')}}">
         @endif
         <meta property="og:type" content="website"/>
       <meta property="og:url" content="{{__('messages.site_name')}}"/>
       <meta property="og:title" content="{{__('messages.site_name')}}"/>
       <meta property="og:image" content="{{asset('public/favicon.png')}}"/>
       <meta property="og:image:width" content="250px"/>
       <meta property="og:image:height" content="250px"/>
       <meta property="og:site_name" content="{{__('messages.site_name')}}"/>
       <meta property="og:description" content="{{__('messages.metadescweb')}}"/>
       <meta property="og:keyword" content="{{__('messages.metakeyboard')}}"/>
       <link rel="shortcut icon" href="{{asset('public/upload/favicon1.ico')}}">
      <!--<link rel="stylesheet" type="text/css" href="{{asset('design/fonts/stylesheet.css')}}">-->
      <link rel="stylesheet" type="text/css" href="{{asset('design/fonts/HoboStd.otf')}}">
      <input type="hidden" id="loginuser" value="{{Session::get('login_user')}}">
      <script type="text/javascript" src="{{asset('design/js/bootstrap.min.js')}}"></script>
      <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="{{asset('design/css/app.css')}}"/>
      <link rel="stylesheet" href="{{asset('design/css/font.css')}}">
      <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
       <link rel="stylesheet" type="text/css" href="{{asset('design/css/bootstrap.min.css')}}">
        
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
     
     
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="{{asset('design/js/dropdown.js')}}"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.5/slick.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/js/lightslider.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.js"></script>
      <script type="text/javascript" src=""></script>
      <script type="text/javascript" src="{{asset('design/js/jquery.mixitup.min.js?v=1')}}"></script>
      <script type="text/javascript" src='https://maps.google.com/maps/api/js?key=AIzaSyC1JUHjsnQZtKx5eBOpG42E_CLoJ1s39AU&sensor=false&libraries=places'></script>
    <script src="{{url('public/js/locationpicker.js')}}"></script>
     <script src="https://js.pusher.com/6.0/pusher.min.js"></script>
  <script type="text/javascript" src="{{asset('public/js/script.js')}}"></script>
  <script type="text/javascript">
        Pusher.logToConsole = true;

    var pusher = new Pusher('ac3d1d9f6d31d556dcd8', {
      cluster: 'ap2'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-channel', function(data) {
        console.log(JSON.stringify(data));
       // alert(data.reciver_id);
        const notification = new Notification({
          effect: 'easex',
          duration: 5000
       });
        if($("#loginuser").val()==data.reciver_id){
          $("#notificationimg").attr("src",data.image);
          notification.success({
              title: data.title, 
              message: data.messages
          });
          console.log("match");
        }
    });
      </script>
   </head>
   
   <body class="rtl">
      
      @include('cookieConsent::index')
      @include('user.cssclass')
      <div class="login-re-modal">
         <div class="modal" id="myModal1">
            <div class="modal-dialog">
               <div class="modal-content">
                    <div id="overlaychk">
                        <div class="cv-spinner">
                           <span class="spinner"></span>
                        </div>
                     </div>
                  <div class="modal-header">
                     <div class="login-modal-head">
                        <button type="button" class="close" data-dismiss="modal">
                        &times;
                        </button>
                     </div>
                  </div>
                  <div class="modal-body">
                     <div id="forgotbody" class="forgotbody">
                        <span class="for_success_msg" id="for_success_msg">  
                        {{__('messages.forgot_email_success')}}
                        </span>
                        <span class="for_error_msg" id="for_error_msg">
                        {{__('messages.forgot_error')}}
                        </span>
                        <form>
                           <label class="for_label">
                           {{__('messages.forgot_text')}}
                           <span class="requiredfield">*</span>
                           </label>
                           <input type="text" required name="phone_for" id="modal-text" placeholder="{{__('messages.forgot_placeholder')}}" class="reuiredtextfields"/>
                        </form>
                        <div class="for_btn_div">
                           <div class="modal-login-button for_btn_div_model" >
                              <button type="button" onclick="forgotaccount()"class="for_button">
                                 <h6 class="for_button_value">   
                                    {{__('messages.forgot_pwd')}}
                                 </h6>
                              </button>
                           </div>
                        </div>
                        <div class="modal-forgot">
                           <a href="javascript:loginmodel()">
                           {{__('messages.login')}}
                           </a>
                        </div>
                     </div>
                     <div class="login-modal" id="loginmodel">
                        <ul class="nav nav-tabs" role="tablist">
                           <li class="nav-item">
                              <a href="#tab1" class="nav-link active" data-toggle="tab">
                              {{__('messages.login')}}
                              </a>
                           </li>
                           <li class="nav-item">
                              <a href="#tab2" class="nav-link" data-toggle="tab">
                              {{__('messages.register')}}
                              </a>
                           </li>
                        </ul>
                        <div class="tab-content">
                           <div id="tab1" class="tab-pane show active">
                              <span id="login_error_msg" class="for_error_msg">  
                              {{__('messages.login_error')}}
                              </span>
                              <label class="for_button_value">
                              {{__('messages.phone_no')}} 
                              <span class="requiredfield">*</span>
                              </label>
                              <input type="text" required name="phone" id="modal-text" placeholder="{{__('messages.phone_no')}}" value="{{isset($_COOKIE['phone'])?$_COOKIE['phone']:''}}">
                              <label class="for_button_value">
                              {{__('messages.password')}}
                              <span class="requiredfield">*</span>
                              </label>
                              <input type="password" required name="password" id="modal-text" placeholder="{{__('messages.password')}}" value="{{isset($_COOKIE['password'])?$_COOKIE['password']:''}}">
                              <div class="modal-re">
                                 <input type="checkbox" name="rem_me" value="1" <?php echo isset($_COOKIE[ 'rem_me'])? "checked": ''?>>
                                 <p>{{__('messages.rem_me')}}</p>
                              </div>
                              <span class="modal-forgot">
                              <a href="javascript:forgotmodel()" >{{__('messages.forgot_u')}}</a>
                              </span>
                              <div class="modal-login-button ">
                                 <button type="button" onclick="loginaccount()" class="for_button">
                                    <h6 class="for_button_value">{{__('messages.login')}}</h6>
                                 </button>
                              </div>
                           </div>
                           <div id="tab2" class="tab-pane ">
                              <span class="for_success_msg" id="reg_success_msg">
                              {{__('messages.register_suceess')}}
                              </span>
                              <span class="for_error_msg" id="reg_error_msg">
                              {{__('messages.reg_error')}}
                              </span>
                              <form action="{{url('userregister')}}" method="post">
                                 {{csrf_field()}}
                                 <label class="for_button_value">        
                                 {{__('messages.name')}}
                                 <span class="requiredfield">*</span>
                                 </label>
                                  <input type="text" required name="name" id="modal-text" placeholder="{{__('messages.name')}}">
                                 <label class="for_button_value">
                                 {{__('messages.email')}}
                                 <span class="requiredfield">*</span>
                                 </label>
                                 <input type="text" required name="email" id="modal-text" placeholder="{{__('messages.email')}}">
                                 
                                
                                 <label class="for_button_value">
                                 {{__('messages.phone_no')}}
                                 <span class="requiredfield">*</span>
                                 </label>
                                 <input type="text" required name="phone_reg" id="modal-text" placeholder="{{__('messages.phone_no')}} Number">
                                 <label class="for_button_value">
                                 {{__('messages.password')}}
                                 <span class="requiredfield">*</span>
                                 </label>
                                 <input type="password" required name="password_reg" id="modal-text" placeholder="{{__('messages.password')}}">
                                 <label class="for_button_value">
                                 {{__('messages.confirm_pwd')}}
                                 <span sclass="requiredfield">*</span>
                                 </label>
                                 <input type="password" required name="con_password_reg" id="modal-text" placeholder="{{__('messages.confirm_pwd')}}" onchange="checkboth(this.value)">
                                 <div class="modal-rg-content">
                                    <p>{{__('messages.reg_fixed')}}</p>
                                 </div>
                                 <div class="modal-login-button">
                                    <button type="button" onclick="registeruser()" class="for_button">
                                       <h6>{{__('messages.register')}}</h6>
                                    </button>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="modal model1my" id="myModal" >
         <div class="modal-dialog modal-1">
            <?php $cartCollection = Cart::getContent(); 
               if($cartCollection->count()==0){?>
            <div class="empty-box">
               <div class="modal-header cart-h">
                  <button type="button" class="close" data-dismiss="modal">
                  <img src='{{asset("design/images/close.png")}}'>
                  </button>
               </div>
               <div class="container">
                  <div class="cart-modal-empty col-md-8">
                     <img src='{{asset("design/images/empty-cart.png")}}'>
                     <h1>{{__('messages.nocart')}}</h1>
                  </div>
               </div>
            </div>
            <?php }else{ ?>
            <div class="modal-content">
               <div class="modal-header cart-h">
                  <button type="button" class="close" data-dismiss="modal">
                  <img src="{{asset('design/images/close.png')}}">
                  </button>
               </div>
               <div class="container">
                  <div class="cart-modal col-md-8">
                     <div class="modal-body main-modal ">
                        <?php $cartCollection = Cart::getContent();$i=0;?>
                        @foreach($cartCollection as $item)
                        <div class="portfolio por-1 col-md-12 row">
                           <div class="por-img">
                              <div class="b-img">
                                 @foreach($allmenu as $ai)  
                                 @if($item->name==$ai->menu_name)
                                 <img src="{{asset('public/upload/images/menu_item_icon/'.$ai->menu_image)}}" class="cartth"> 
                                 @endif
                                 @endforeach
                              </div>
                           </div>
                           <div class="b-text">
                              <div class="box-spa">
                                 <h1>{{$item->name}} ({{ucfirst($item->attributes[0]['size'])}})</h1>
                                 <h2>
                                    @foreach($item->attributes[0]['inter'] as $cartinter) 
                                    @foreach($ingredient as $me)    
                                    @if($cartinter==$me->id)
                                    <span>{{$me->item_name}},</span>
                                    @endif
                                    @endforeach 
                                    @endforeach
                                 </h2>
                                 <p>{{$item->quantity}}
                                    <img src="{{asset('design/images/cross.png')}}" style="width: 10px !important;height: 10px !important;">
                                    {{Session::get("usercurrency").number_format($item->price, 2, '.', '')}}
                                 </p>
                                
                              </div>
                              <span class="price">
                                 <?php $totalamount=(float)$item->quantity*(float)$item->price;?>
                                 <a href="{{url('deletecartitem/'.$item->id)}}">
                                 <i class="fa fa-trash-o" aria-hidden="true">
                                 </i>
                                 </a>
                                 <h1>
                                    {{Session::get("usercurrency")}}{{number_format($totalamount, 2, '.', '')}}
                                 </h1>
                              </span>
                           </div>
                        </div>
                        @endforeach
                     </div>
                     <div class="total">
                        <h1>{{__('messages.subtotal')}} :</h1>
                        <span>
                        {{Session::get("usercurrency").number_format(Cart::getTotal(), 2, '.', '')}} 
                        </span>
                     </div>
                     <?php if(Session::get("orderstatus")==1){ ?>
                     <div class="viewcart">
                        <h1>
                           <a href="{{url('cartdetails')}}" class="viewcarta">
                           {{__('messages.view_cart')}}
                           </a>
                        </h1>
                     </div>
                     <?php }?>
                     <?php if(Session::get("orderstatus")==0){ ?>
                     <div class="last-box">
                        <div class="Delivery">
                           <img src="{{asset('design/images/delivery.png')}}" style="width:50px">
                        </div>
                        <div class="last-text">
                           <h1>{{__('messages.offline_order')}}</h1>
                           <p>{{__('messages.off_time')}}</p>
                        </div>
                     </div>
                     <?php }?>
                  </div>
               </div>
            </div>
            <?php }?>
         </div>
      </div>
      <div class="first-section">
         <div class="img">
         </div>
         <div class="container kb-nav">
            <div class="row">
               <div class="kb-nav-logo">
                  <a href="{{url('/')}}">
                  <img src="{{Session::get('logo')}}" class="img-fluid">
                  </a>
               </div>
               <div class="kb-menu">
                  <ul class="p-0">
                     <li>
                        <a href="{{url('/')}}" class="for_button_value">
                        {{ __('messages.home') }}
                        </a>
                     </li>
                     <li>
                        <a href="{{url('aboutus')}}" class="for_button_value">
                        {{__('messages.aboutus')}}
                        </a>
                     </li>
                     <li>
                        <a href="{{url('service')}}" class="for_button_value">
                        {{__('messages.service')}}
                        </a>
                     </li>
                     <li>
                        <a href="{{url('contactus')}}" class="for_button_value">
                        {{__('messages.contact')}}
                        </a>
                     </li>
                  </ul>
               </div>
               <div class="kd-social">
                  <div class="login">
                     <?php if(empty(Session::get('login_user'))){?>
                     <a href="#" data-toggle="modal" data-target="#myModal1">
                     <i class="fa fa-user" aria-hidden="true"></i>
                     </a>
                     <?php }else{?>
                     <a href="{{url('myaccount')}}">
                     <i class="fa fa-user" aria-hidden="true"></i>
                     </a>
                     <?php }?>
                     <a href="#" data-toggle="modal" data-target="#myModal">
                     <i class="fa fa-shopping-cart" aria-hidden="true">
                     <span id="totalcart">
                     <?php $cartCollection = Cart::getContent();
                        $carttotal=0;
                         if($cartCollection->count()!=0)
                             {
                                 $carttotal=$cartCollection->count();
                                 echo '<div class="cric">'.$cartCollection->count().'</div>';
                             }
                        ?> 
                     </span>
                     <input type="hidden" id="carttotal" value="{{$carttotal}}">
                     </i></a>
                  </div>
                  <a href="{{ Session::get('facebook')}}"  target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                  <a href="{{ Session::get('twitter')}}"  target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                  <a href="{{ Session::get('whatsapp')}}"  target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
               </div>
               <div class="tm">
                  <div id="toggle" onclick="changetab()">
                     <div class="one"></div>
                     <div class="two"></div>
                     <div class="three"></div>
                  </div>
               </div>
               <div class="col-12">
                  <div id="menu">
                     <ul class="p-0">
                        <li><a href="{{url('/')}}">{{ __('messages.home') }}</a></li>
                        <li><a href="{{url('aboutus')}}">{{__('messages.aboutus')}}</a></li>
                        <li><a href="{{url('service')}}">{{__('messages.service')}}</a></li>
                        <li><a href="{{url('contactus')}}">{{__('messages.contact')}}</a></li>
                     </ul>
                  </div>
               </div>
               <div class="kb-text-box">
                  <h1>{{__('messages.silder1h')}}</h1>
                  <h2>{{__('messages.silderh2')}}</h2>
                  <p>{{__('messages.silderp')}}.</p>
               </div>
            </div>
         </div>
      </div>
      <div class="secound-section">
         <div class="container">
            <div class="col-md-12">
               <div class="row">
                  <div class="col-md-6 about-img">
                     <img src="{{Session::get('second_sec_img')}}" class="img-fluid">
                  </div>
                  <div class="col-md-6 about-text">
                     <img src="{{Session::get('secong_icon_img')}}" class="img-fluid">
                     <h5>{{__('messages.silder23')}}
                     </h5>
                     <p>
                        {{__('messages.psilder23')}}
                     </p>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="heading">
         <h1>{{__('messages.menu_title')}}</h1>
      </div>
      <div class="main-box">
         <div class="container">
            <div class="slider responsive topslider">
               @foreach($category as $ca)
               <div>
                 <button type="button" class="filter active tab-b" data-filter=".{{$ca->id}}">
                     <?php $img=asset('public/upload/images/menu_cat_icon/').'/'.$ca->cat_icon; ?>
                     <div class="category_img_sb">
                        <div class="img-1 coman" style="background-image: url('{{$img}}');"></div>
                     </div>
                     <h1>{{$ca->cat_name}}</h1>
                  </button>
               </div>
               @endforeach
            </div>
         </div>
         <div class="prev">
            <span class="fa fa-chevron-left" aria-hidden="true"></span>
         </div>
         <div class="next">
            <span class="fa fa-chevron-right" aria-hidden="true"></span>
         </div>
      </div>
      <div class="container">
         <div class="">
           <div id="portfoliolist">
                <?php 
                        for($i=0;$i<count($items);$i++){
                             echo "<div class='row'>";
                             if(isset($items[$i])){ ?>
                                   <div class="portfolio {{$items[$i]->categoryitem->id}} burger w3-animate-zoom" data-cat="{{$items[$i]->categoryitem->id}}" style="display-block">
                                      <div class="items">
                                          <input type="hidden" name="selsize{{$i}}" id="selsize{{$i}}" value="m" />
                                         <div class="b-img">
                                            <a href="javascript:gotodetail('{{$items[$i]->id}}','{{$i}}')"><img src="{{asset('public/upload/images/menu_item_icon/'.$items[$i]->menu_image)}}"></a>
                                         </div>
                                         <div class="bor">
                                            <div class="b-text">
                                               <h1><a href="javascript:gotodetail('{{$items[$i]->id}}','{{$i}}')">{{$items[$i]->menu_name}}</a></h1>
                                               <p>
                                                  {{substr($items[$i]->description,0,75)}}
                                               </p>
                                               <div class="size_main_sb">
                                                  <a href="javascript:changepriceqty({{$i}},'s',{{$items[$i]->id}},'{{$items[$i]->small_price}}')" id="s{{$i}}">S</a>
                                                  <a href="javascript:changepriceqty({{$i}},'m',{{$items[$i]->id}},'{{$items[$i]->medium_price}}')" class="active" id="m{{$i}}">M</a>
                                                  <a href="javascript:changepriceqty({{$i}},'l',{{$items[$i]->id}},'{{$items[$i]->large_price}}')" id="l{{$i}}">L</a>
                                               </div>
                                            </div>
                                            <div class="price">
                                               <h1>{{Session::get("usercurrency")}} <span id="priceitem{{$i}}">{{$items[$i]->medium_price}}</span></h1>
                                               <div class="cart">
                                                  <a href="javascript:gotodetail('{{$items[$i]->id}}','{{$i}}')">{{__('messages.addcart')}}</a>
                                               </div>
                                            </div>
                                         </div>
                                      </div>
                                   </div>
                                
                             <?php $i=$i+1;}
                             if(isset($items[$i])){ ?>
                                   <div class="portfolio {{$items[$i]->categoryitem->id}} burger w3-animate-zoom" data-cat="{{$items[$i]->categoryitem->id}}">
                                      <div class="items">
                                          <input type="hidden" name="selsize{{$i}}" id="selsize{{$i}}" value="m" />
                                         <div class="b-img">
                                            <a href="javascript:gotodetail('{{$items[$i]->id}}','{{$i}}')"><img src="{{asset('public/upload/images/menu_item_icon/'.$items[$i]->menu_image)}}"></a>
                                         </div>
                                         <div class="bor">
                                            <div class="b-text">
                                               <h1><a href="javascript:gotodetail('{{$items[$i]->id}}','{{$i}}')">{{$items[$i]->menu_name}}</a></h1>
                                               <p>
                                                  {{substr($items[$i]->description,0,75)}}
                                               </p>
                                               <div class="size_main_sb">
                                                  <a href="javascript:changepriceqty({{$i}},'s',{{$items[$i]->id}},'{{$items[$i]->small_price}}')" id="s{{$i}}">S</a>
                                                  <a href="javascript:changepriceqty({{$i}},'m',{{$items[$i]->id}},'{{$items[$i]->medium_price}}')" class="active" id="m{{$i}}">M</a>
                                                  <a href="javascript:changepriceqty({{$i}},'l',{{$items[$i]->id}},'{{$items[$i]->large_price}}')" id="l{{$i}}">L</a>
                                               </div>
                                            </div>
                                            <div class="price">
                                               <h1>{{Session::get("usercurrency")}} <span id="priceitem{{$i}}">{{$items[$i]->medium_price}}</span></h1>
                                               <div class="cart">
                                                  <a href="javascript:gotodetail('{{$items[$i]->id}}','{{$i}}')">{{__('messages.addcart')}}</a>
                                               </div>
                                            </div>
                                         </div>
                                      </div>
                                   </div>
                                 
                             <?php } 
                             echo "</div>";
                        } ?>
                        </div>
                      
              <!-- @foreach($items as $it)
               <div class="portfolio {{$it->categoryitem->id}} col-md-6 burger" data-cat="{{$it->categoryitem->id}}">
                  <div class="items">
                      <input type="hidden" name="selsize{{$i}}" id="selsize{{$i}}" value="m" />
                     <div class="b-img">
                        <a href="javascript:gotodetail('{{$it->id}}','{{$i}}')"><img src="{{asset('public/upload/images/menu_item_icon/'.$it->menu_image)}}"></a>
                     </div>
                     <div class="bor">
                        <div class="b-text">
                           <h1><a href="javascript:gotodetail('{{$it->id}}','{{$i}}')">{{$it->menu_name}}</a></h1>
                           <p>
                              {{substr($it->description,0,75)}}
                           </p>
                           <div class="size_main_sb">
                              <a href="javascript:changepriceqty({{$i}},'s',{{$it->id}})" id="s{{$i}}">S</a>
                              <a href="javascript:changepriceqty({{$i}},'m',{{$it->id}})" class="active" id="m{{$i}}">M</a>
                              <a href="javascript:changepriceqty({{$i}},'l',{{$it->id}})" id="l{{$i}}">L</a>
                           </div>
                        </div>
                        <div class="price">
                           <h1>{{Session::get("usercurrency")}} <span id="priceitem{{$i}}">{{$it->medium_price}}</span></h1>
                           <div class="cart">
                              <a href="javascript:gotodetail('{{$it->id}}','{{$i}}')">{{__('messages.addcart')}}</a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <?php //$i++;?>
               @endforeach-->
            </div>
         </div>
      </div>
      <div class="clear-fix"></div>
      <div class="play">
         <div class="container">
            <div class="row">
               <div class="col-md-6">
                  <div class="play-b">
                     <img src="{{Session::get('footer_up_img')}}">
                  </div>
               </div>
               <div class="col-md-6 text-box">
                  <div class="head">
                     <h1>{{__('messages.bannerh')}}</h1>
                     <p>{{__('messages.bannerp')}}</p>
                  </div>
                  <h2>{{__('messages.bennerh2')}}</h2>
                  <ul>
                     <li>
                        <span>
                           <div class="crl"></div>
                        </span>
                        {{__('messages.b1')}}
                     </li>
                     <li>
                        <span>
                           <div class="crl"></div>
                        </span>
                        {{__('messages.b2')}}
                     </li>
                     <li>
                        <span>
                           <div class="crl"></div>
                        </span>
                        {{__('messages.b3')}}
                     </li>
                     <li>
                        <span>
                           <div class="crl"></div>
                        </span>
                        {{__('messages.b4')}}
                     </li>
                  </ul>
                  <div class="row">
                      @if($setting->have_playstore=='1')
                     <div class="col-md-5 col-sm-5 col-5 google">
                        <a href="{{ Session::get('playstore')}}" target="_blank"><img src="{{asset('design/images/Google-Play-icon.png')}}" class="img-fluid"></a>
                     </div>
                     @endif
                     @if($setting->have_appstore=='1')
                     <div class="col-md-5 col-sm-5 col-5 apple">
                        <a href="{{ Session::get('appstore')}}" target="_blank"><img src="{{asset('design/images/App-Store-icon.png')}}" class="img-fluid"></a>
                     </div>
                     @endif
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="footer-section">
         <div class="footer">
            <div class="container kb-footer">
               <div class="row">
                  <div class="col-md-3 about">
                     <img src="{{Session::get('logo')}}">
                     <p>{{__('messages.footer_text')}}</p>
                     <div class="footer-social">
                        <a href="{{ Session::get('facebook')}}" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        <a href="{{ Session::get('twitter')}}"  target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        <a href="{{ Session::get('linkedin')}}" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                        <a href="{{ Session::get('google_plus_id')}}" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                        <a href="{{ Session::get('whatsapp')}}" target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
                     </div>
                  </div>
                  <div class="col-md-3 info">
                     <div class="fo-text">
                        <h1>{{__('messages.information')}}</h1>
                     </div>
                     <ul class="textdata">
                         <li><a href="{{url('/')}}" id="link1">{{ __('messages.home') }}</a></li>
                        <li><a href="{{url('aboutus')}}" id="link2">{{__('messages.aboutus')}}</a></li>
                        <li><a href="{{url('service')}}" id="link3">{{__('messages.service')}}</a></li>
                        <li><a href="{{url('contactus')}}" id="link4">{{__('messages.contact')}}</a></li>
                     </ul>
                  </div>
                  <div class="col-md-3 info">
                     <div class="fo-text">
                        <h1>{{__('messages.myaccount')}}</h1>
                     </div>
                     <ul class="textdata">
                        @if(empty(Session::get('login_user')))
                        <li><a href="#" data-toggle="modal" data-target="#myModal1">{{__('messages.myorder')}}</a></li>
                        @endif
                        @if(!empty(Session::get('login_user')))
                        <li><a href="{{url('myaccount')}}">{{__('messages.myorder')}}</a></li>
                        @endif
                        <?php $cartCollection = Cart::getContent();?>
                        @if(count($cartCollection)!=0)
                        <li><a href="{{url('cartdetails')}}">{{__('messages.checkout')}}</a></li>
                        @endif
                        @if(count($cartCollection)==0)
                        <li><a href="#" data-toggle="modal" data-target="#myModal">{{__('messages.checkout')}}</a></li>
                        @endif
                        <li><a  href="#" data-toggle="modal" data-target="#myModal">{{__('messages.cart')}}</a></li>
                        <li><a href="{{url('termofuse')}}">{{__('messages.terms')}}</a></li>
                     </ul>
                  </div>
                  <div class="col-md-3 info">
                     <div class="fo-text">
                        <h1>{{__('messages.contact_us')}}</h1>
                     </div>
                     <div class="f-location">
                        <img src="{{asset('design/images/location.png')}}">
                     </div>
                     <span>
                     {{Session::get('address')}}
                     </span>
                     <div class="f-location">
                        <img src="{{asset('design/images/phone.png')}}">
                     </div>
                     <span>
                     {{Session::get('phone')}}
                     </span>
                     <div class="f-location">
                        <img src="{{asset('design/images/email.png')}}">
                     </div>
                     <span>
                     {{Session::get('email')}}
                     </span>
                  </div>
               </div>
            </div>
            <div class="right">
               <div class="container">
                  <div class="row">
                     <div class="col-md-6">
                        <h1>{{__('messages.copyright')}} © {{Session::get('current_year')}} {{__('messages.site_name')}}. {{__('messages.f1')}}.</h1>
                     </div>
                     <div class="col-md-6 v-box">
                        <div class="v-img">
                           <a href="#"><img src="{{asset('design/images/v-1.png')}}"></a>
                        </div>
                        <div class="v-img">
                           <a href="#"><img src="{{asset('design/images/v-2.png')}}"></a>
                        </div>
                        <div class="v-img">
                           <a href="#"><img src="{{asset('design/images/v-3.png')}}"></a>
                        </div>
                        <div class="v-img">
                           <a href="#"><img src="{{asset('design/images/v-4.png')}}"></a>
                        </div>
                        <div class="v-img">
                           <a href="#"><img src="{{asset('design/images/v-5.png')}}"></a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="img-aa"></div>
   </body>
   <div class="modal modal-2" id="myModal2">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header logout">
               <h4 class="modal-title">{{__('messages.register')}}</h4>
               <p>{{Session::get('user_phone')}}</p>
               <h1>{{__('messages.logout_msg')}}</h1>
               <div class="logout-but">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('messages.cancel')}}</button>
                  <button type="button" class="btn-1" data-dismiss="modal" onclick="logout()"><i class="fa fa-sign-out" aria-hidden="true"></i>{{__('messages.logout')}}
                  </button>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="notification">
        <section class="logo">
            <div id="face" >
                <img id="notificationimg" src="{{asset('public/upload/profile/my-account-pro.png')}}" style="height: 50px;width: 50px;">
            </div>
        </section>
        <section class="body">
            <span class="title">Success</span>
            <p class="message" style="height:80%">Your change was made</p>
        </section>
    </div>
   <input type="hidden" id="currency" value='{{Session::get("usercurrency")}}' />
   <input type="hidden" id="addcart" value='{{__("messages.addcart")}}' />
   <input type="hidden" id="path_site" value="{{url('/')}}" />
   <input type="hidden" id="forgot_error" value="{{__('messages.forgot_error')}}"/>
   <input type="hidden" id="reg_error" value="{{__('messages.reg_error')}}"/>
   <input type="hidden" id="pwdmatch" value="{{__('messages.pwdmatch')}}" />
   <input type="hidden" id="login_error" value="{{__('messages.login_error')}}" />
   <input type="hidden" id="required_field" value="{{__('messages.required_field')}}" />
   <input type="hidden" id="login_error" value="{{__('messages.login_error')}}" />
   <input type="hidden" id="forgot_error_2" value="{{__('messages.forgot_error_2')}}">
  
   <script type="text/javascript" src="{{ URL::to('public/js/code.js?v=14000')}}"></script>
</html>
