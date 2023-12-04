<!DOCTYPE html>
<html>
   <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      
      <title>{{__('messages.site_name')}}</title>
      @yield('metadata')
       
      <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
      
      <link rel="stylesheet" href="https://getuikit.com/assets/uikit/dist/css/uikit.css?nc=12">
     
          @if($setting->is_rtl==0)
         <link rel="stylesheet" type="text/css" href="{{asset('design/css/style.css?v=123')}}">
         @else
         <link rel="stylesheet" type="text/css" href="{{asset('design/css/rtl.css?v=454647')}}">
         @endif
          <input type="hidden" id="loginuser" value="{{Session::get('login_user')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('design/css/bootstrap.min.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('design/css/app.css')}}"/>
      <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="{{asset('design/css/font.css')}}">
      
      <link rel="stylesheet" type="text/css" href="{{asset('design/fonts/stylesheet.css')}}">
      
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
      <script type="text/javascript" src="{{asset('design/js/dropdown.js')}}"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.5/slick.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/js/lightslider.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.js"></script>
      <script type="text/javascript" src="{{asset('design/js/jquery.mixitup.min.js')}}"></script>
      <script type="text/javascript" src="{{ URL::to('js/code.js')}}"></script>
      <script type="text/javascript" src="{{asset('design/js/bootstrap.min.js')}}"></script>
       <script type="text/javascript" src='https://maps.google.com/maps/api/js?key={{Config::get("mapdetail.key")}}&sensor=false&libraries=places'></script>
        <script src="{{url('js/locationpicker.js')}}"></script>
        <script src="https://js.pusher.com/6.0/pusher.min.js"></script>
  <script type="text/javascript" src="{{asset('js/script.js')}}"></script>
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
   <style>
       .activeslider {
           border: 3px solid #e00b2b !important;
       }
   </style>
   <body class="rtl">
      @include('user.cssclass')
      @include('cookieConsent::index')
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
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
               </div>
               <div class="modal-body">
                  <div id="forgotbody">
                     <span id="for_success_msg">{{__('messages.forgot_email_success')}}</span>
                     <span id="for_error_msg">{{__('messages.forgot_error')}}</span>
                     <form class="for">
                        <label>{{__('messages.forgot_text')}}<span>*</span></label>
                        <input type="text" required name="phone_for" id="modal-text" placeholder="{{__('messages.forgot_placeholder')}}" >
                     </form>
                     <div class="for-1">
                        <div class="modal-login-button">
                           <button type="button" onclick="forgotaccount()">
                              <h6>{{__('messages.forgot_pwd')}}</h6>
                           </button>
                        </div>
                     </div>
                     <div class="modal-forgot">
                        <a href="javascript:loginmodel()">{{__('messages.login')}}</a>
                     </div>
                  </div>
                  <div class="login-modal" id="loginmodel">
                     <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                           <a href="#tab1" id="logintab" class="nav-link active" data-toggle="tab">{{__('messages.login')}}</a>
                        </li>
                        <li class="nav-item">
                           <a href="#tab2" id="regtab" class="nav-link" data-toggle="tab">{{__('messages.register')}}</a>
                        </li>
                     </ul>
                     <div class="tab-content">
                        <div id="tab1" class="tab-pane show active">
                           <span id="login_error_msg">{{__('messages.login_error')}}</span>
                           <form>
                              {{csrf_field()}}
                              <label>{{__('messages.phone_no')}} <span>*</span></label>
                              <input type="text" required name="phone" id="modal-text" placeholder="{{__('messages.phone_no')}}" value="{{isset($_COOKIE['phone'])?$_COOKIE['phone']:''}}">
                              <label>{{__('messages.password')}}<span>*</span></label>
                              <input type="password" required name="password" id="modal-text" placeholder="{{__('messages.password')}}" value="{{isset($_COOKIE['password'])?$_COOKIE['password']:''}}">
                           </form>
                           <div class="modal-re">
                              <input type="checkbox" name="rem_me" value="1" <?php echo isset($_COOKIE[ 'rem_me'])? "checked": ''?>>
                              <p>{{__('messages.rem_me')}}</p>
                           </div>
                           <span class="modal-forgot">
                           <a href="javascript:forgotmodel()" >{{__('messages.forgot_u')}}</a>
                           </span>
                           <div class="modal-login-button">
                              <button type="button" onclick="loginaccount()">
                                 <h6>{{__('messages.login')}}</h6>
                              </button>
                           </div>
                        </div>
                        <div id="tab2" class="tab-pane">
                           <span id="reg_success_msg">{{__('messages.register_suceess')}}</span>
                           <span id="reg_error_msg">{{__('messages.reg_error')}}</span>
                           <form action="{{url('userregister')}}" method="post">
                              {{csrf_field()}}
                              <label>{{__('messages.name')}} <span>*</span></label>
                              <input type="text" required name="name" id="modal-text" placeholder="{{__('messages.name')}}">
                              <label class="for_button_value">{{__('messages.email')}} <span class="requiredfield">*</span></label>
                               <input type="text" required name="email" id="modal-text" placeholder="{{__('messages.email')}}">
                              <label>{{__('messages.phone_no')}} <span>*</span></label>
                              <input type="text" required name="phone_reg" id="modal-text" placeholder="{{__('messages.phone_no')}}">
                              <label>{{__('messages.password')}}<span>*</span></label>
                              <input type="password" required name="password_reg" id="modal-text" placeholder="{{__('messages.password')}}">
                              <label>{{__('messages.confirm_pwd')}}<span>*</span></label>
                              <input type="password" required name="con_password_reg" id="modal-text" placeholder="{{__('messages.confirm_pwd')}}" onchange="checkdata(this.value)">
                              <div class="modal-rg-content">
                                 <p>{{__('messages.reg_fixed')}}</p>
                              </div>
                              <div class="modal-login-button">
                                 <button type="button" onclick="registeruser()">
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
      <div class="modal" id="myModal">
        <div class="modal-dialog modal-1">
            <?php $cartCollection = Cart::getContent(); 
               if($cartCollection->count()==0){
               
                     echo ' 
                     <div class="empty-box">
                     <div class="modal-header cart-h">
                      <button type="button" class="close" data-dismiss="modal">
                      <img src="'.asset("design/images/close.png").'">
                      </button>
                      </div>
                      <div class="container">
                      <div class="cart-modal-empty col-md-8">
                      <img src="'.asset("design/images/empty-cart.png").'">
                      <h1>'.__("messages.nocart").'</h1>
                        </div>
                         </div>
                         </div>';
                        }
               else{
                ?>
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
                                     <img src="{{asset('upload/images/menu_item_icon/'.$ai->menu_image)}}" width="85px">
                                   @endif
                                 @endforeach
                              </div>
                           </div>
                           <div class="b-text">
                              <div class="box-spa">
                                 <h1>{{$item->name}} ({{ucfirst($item->attributes[0]['size'])}})</h1>
                                 <h2>@foreach($item->attributes[0]['inter'] as $cartinter)
                                    @foreach($menu_interdient as $me)
                                    @if($cartinter==$me->id)
                                    <span>{{$me->item_name}},</span>
                                    @endif
                                    @endforeach
                                    @endforeach
                                 </h2>
                                 <p>{{$item->quantity}} <img src="{{asset('design/images/cross.png')}}" style="width: 10px !important;height: 10px !important;"> {{$curreny.number_format($item->price, 2, '.', '')}}
                                 </p>
                              </div>
                              <span class="price">
                                 <?php $totalamount=(float)$item->quantity*(float)$item->price;?>
                                 <a href="{{url('deletecartitem/'.$item->id)}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                 <h1>{{$curreny}}{{number_format($totalamount, 2, '.', '')}}</h1>
                              </span>
                           </div>
                        </div>
                        @endforeach
                     </div>
                     <div class="total">
                        <h1>{{__("messages.subtotal")}}:</h1>
                        <?php $cartCollection = Cart::getContent();
                           $totalamountarr=array();
                           foreach ($cartCollection as $car) {
                              $totalamount="";
                              $totalamount=(float)$car->quantity*(float)$car->price;
                              $totalamountarr[]=round($totalamount,2);
                           
                           }
                           
                           ?>
                        <span>{{$curreny.number_format(Cart::getTotal(), 2, '.', '')}} </span>
                     </div>
                     <?php if($setting->order_status==1){ ?>
                     <div class="viewcart">
                        <h1>
                           <a href="{{url('cartdetails')}}" class="viewcarta">
                           {{__('messages.view_cart')}}
                           </a>
                        </h1>
                     </div>
                     <?php }?>
                     <?php if($setting->order_status==0){ ?>
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
      <div class="detail-background-box">
         <div class="container kb-nav detail-nav">
            <div class="first-section">
               <div class="row detail-navbar">
                  <div class="kb-nav-logo">
                     <a href="{{url('/')}}">
                     <img src="{{asset('upload/web/').'/'.$setting->logo}}" class="img-fluid">
                     </a>
                  </div>
                  <div class="kb-menu">
                     <ul class="p-0">
                        <li><a href="{{url('/')}}" id="link1">{{ __('messages.home') }}</a></li>
                        <li><a href="{{url('aboutus')}}" id="link2">{{__('messages.aboutus')}}</a></li>
                        <li><a href="{{url('service')}}" id="link3">{{__('messages.service')}}</a></li>
                        <li><a href="{{url('contactus')}}" id="link4">{{__('messages.contact')}}</a></li>
                     </ul>
                  </div>
                  <div class="kd-social">
                     <div class="login">
                        <?php if(empty(Session::get('login_user'))){?>
                        <a href="#" data-toggle="modal" data-target="#myModal1"><i class="fa fa-user" aria-hidden="true"></i></a>
                        <?php }else{?>
                        <a href="{{url('myaccount')}}" ><i class="fa fa-user" aria-hidden="true"></i></a>
                        <?php }?>
                        <a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-shopping-cart" aria-hidden="true">
                        <span id="totalcart">
                        <?php $cartCollection = Cart::getContent();
                           $carttotal=0;
                            if($cartCollection->count()!=0)
                                {
                                    $carttotal=$cartCollection->count();
                                    echo '<div class="cric" style="border: 1px solid white;">'.$cartCollection->count().'</div>';
                                }
                           ?> 
                        </span>
                        <input type="hidden" id="carttotal" value="{{$carttotal}}">
                        </i></a>
                     </div>
                     <a href="{{$setting->facebook_id}}"  target="_blank"> <i class="fa fa-facebook" aria-hidden="true"></i></a>
                     <a href="{{$setting->twitter_id}}"  target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                     <a href="{{$setting->whatsapp}}"  target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
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
               </div>
            </div>
         </div>
        
      </div>
      <div class="main-box main-box-2">
    		<div class="container">
    			<div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slider>
                    <ul class="uk-slider-items uk-child-width-1-2 uk-child-width-1-3@m uk-grid">
                        <?php $i=0;?>
                        	@foreach($category as $ca)
                        <li>
                            <div class="uk-panel">
                                <button type="button" id="catebtn{{$i}}" class="filter  tab-b " data-filter=".{{$ca->id}}" onclick="divup({{$i}})">
                                    <?php $img=asset('upload/images/menu_cat_icon/').'/'.$ca->cat_icon; ?>
                                     <div class="category_img_sb">
                                        <div class="img-1 coman" style="background-image: url('{{$img}}');"></div>
                                     </div>
                                     <h1>{{$ca->cat_name}}</h1>
                                        <div class="uk-position-center uk-panel"></div>
                                    
                                </button>
                            </div>
                        </li>
                        <?php $i++;?>
                        @endforeach
                    </ul>
                    <a class="uk-position-center-left uk-position-small" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
                    <a class="uk-position-center-right uk-position-small" href="#" uk-slidenav-next uk-slider-item="next"></a>
                </div>
    			
    		</div>
      </div>
      <input type="hidden" id="totalcategory" value="{{$i}}"/>
      
      
      <div class="container">
         <p id="category_div" ></p>
          <div id="portfoliolist" style="display:none">
                <?php 
                        for($i=0;$i<count($items);$i++){ ?>
                           @foreach($category as $ca)
                             <?php echo "<div class='row'>";
                             
                             if(isset($items[$i])&&$ca->id==$items[$i]->category){ ?>
                                   <div class="portfolio {{$items[$i]->categoryitem->id}} burger w3-animate-zoom" data-cat="{{$items[$i]->categoryitem->id}}" style="display-block">
                                      <div class="items">
                                          <input type="hidden" name="selsize{{$i}}" id="selsize{{$i}}" value="m" />
                                         <div class="b-img">
                                            <a href="javascript:gotodetail('{{$items[$i]->id}}','{{$i}}')"><img src="{{asset('upload/images/menu_item_icon/'.$items[$i]->menu_image)}}"></a>
                                         </div>
                                         <div class="bor">
                                            <div class="b-text">
                                               <h1><a href="javascript:gotodetail('{{$items[$i]->id}}','{{$i}}')">{{$items[$i]->menu_name}}</a></h1>
                                               <p>
                                                  {{substr($items[$i]->description,0,75)}}
                                               </p>
                                               <div class="size_main_sb">
                                                  <a href="javascript:changepriceqty({{$i}},'s',{{$items[$i]->id}},'{{$items[$i]->small_price}}','s')" id="s{{$i}}s" class="sizename{{$i}}s">S</a>
                                                  <a href="javascript:changepriceqty({{$i}},'m',{{$items[$i]->id}},'{{$items[$i]->medium_price}}','s')" class="active" id="m{{$i}}s" class="sizename{{$i}}s">M</a>
                                                  <a href="javascript:changepriceqty({{$i}},'l',{{$items[$i]->id}},'{{$items[$i]->large_price}}','s')" id="l{{$i}}s" class="sizename{{$i}}s">L</a>
                                               </div>
                                            </div>
                                            <div class="price">
                                               <h1>{{$curreny}}<span id="priceitem{{$i}}s">{{$items[$i]->medium_price}}</span></h1>
                                               <div class="cart">
                                                  <a href="javascript:gotodetail('{{$items[$i]->id}}','{{$i}}')">{{__('messages.addcart')}}</a>
                                               </div>
                                            </div>
                                         </div>
                                      </div>
                                   </div>
                                
                             <?php $i=$i+1;}
                             if(isset($items[$i])&&$ca->id==$items[$i]->category){ ?>
                                   <div class="portfolio {{$items[$i]->categoryitem->id}} burger w3-animate-zoom" data-cat="{{$items[$i]->categoryitem->id}}">
                                      <div class="items">
                                          <input type="hidden" name="selsize{{$i}}" id="selsize{{$i}}" value="m" />
                                         <div class="b-img">
                                            <a href="javascript:gotodetail('{{$items[$i]->id}}','{{$i}}')"><img src="{{asset('upload/images/menu_item_icon/'.$items[$i]->menu_image)}}"></a>
                                         </div>
                                         <div class="bor">
                                            <div class="b-text">
                                               <h1><a href="javascript:gotodetail('{{$items[$i]->id}}','{{$i}}')">{{$items[$i]->menu_name}}</a></h1>
                                               <p>
                                                  {{substr($items[$i]->description,0,75)}}
                                               </p>
                                               <div class="size_main_sb">
                                                  <a href="javascript:changepriceqty({{$i}},'s',{{$items[$i]->id}},'{{$items[$i]->small_price}}','s')" id="s{{$i}}s" class="sizename{{$i}}s">S</a>
                                                  <a href="javascript:changepriceqty({{$i}},'m',{{$items[$i]->id}},'{{$items[$i]->medium_price}}','s')" class="active sizename{{$i}}s" id="m{{$i}}s">M</a>
                                                  <a href="javascript:changepriceqty({{$i}},'l',{{$items[$i]->id}},'{{$items[$i]->large_price}}','s')" id="l{{$i}}s" class="sizename{{$i}}s">L</a>
                                               </div>
                                            </div>
                                            <div class="price">
                                               <h1>{{$curreny}}<span id="priceitem{{$i}}s">{{$items[$i]->medium_price}}</span></h1>
                                               <div class="cart">
                                                  <a href="javascript:gotodetail('{{$items[$i]->id}}','{{$i}}')">{{__('messages.addcart')}}</a>
                                               </div>
                                            </div>
                                         </div>
                                      </div>
                                   </div>
                                 
                             <?php } 
                             echo "</div>"; ?>
                             @endforeach
                             <?php
                        } ?>
                        </div>
            </div>
      </div>
      <div id="main_content">
         @yield('content')
      </div>
      <div class="footer-section">
        <div class="footer">
          <div class="container kb-footer">
               <div class="row">
                  <div class="col-md-3 about">
                     <img src="{{asset('upload/web/').'/'.$setting->logo}}">
                     <p>{{__('messages.footer_text')}}</p>
                     <div class="footer-social">
                        <a href="{{$setting->facebook_id}}" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        <a href="{{$setting->twitter_id}}"  target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        <a href="{{$setting->linkedin_id}}" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                        <a href="{{$setting->google_plus_id}}" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                        <a href="{{$setting->whatsapp}}" target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
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
                     {{$setting->address}}
                     </span>
                     <div class="f-location">
                        <img src="{{asset('design/images/phone.png')}}">
                     </div>
                     <span>
                     {{$setting->phone}}
                     </span>
                     <div class="f-location">
                        <img src="{{asset('design/images/email.png')}}">
                     </div>
                     <span>
                     {{$setting->email}}
                     </span>
                  </div>
               </div>
            </div>
            <div class="right">
               <div class="container">
                  <div class="row">
                     <div class="col-md-6">
                        <h1>{{__('messages.copyright')}} © {{date('Y')}} {{__('messages.site_name')}}. {{__('messages.f1')}}.</h1>
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
      <div class="notification">
        <section class="logo">
            <div id="face" >
                 <img id="notificationimg" src="{{asset('upload/profile/my-account-pro.png')}}" style="height: 50px;width: 50px;">
            </div>
        </section>
        <section class="body">
            <span class="title">Success</span>
            <p class="message" style="height:80%">Your change was made</p>
        </section>
    </div>
      <input type="hidden" id="currency" value='{{$curreny}}' />
      <input type="hidden" id="addcart" value='{{__("messages.addcart")}}' />
      <input type="hidden" id="path_site" value="{{url('/')}}" />
      <input type="hidden" id="forgot_error" value="{{__('messages.forgot_error')}}"/>
      <input type="hidden" id="reg_error" value="{{__('messages.reg_error')}}"/>
      <input type="hidden" id="pwdmatch" value="{{__('messages.pwdmatch')}}" />
      <input type="hidden" id="login_error" value="{{__('messages.login_error')}}" />
      <input type="hidden" id="required_field" value="{{__('messages.required_field')}}" />
      <input type="hidden" id="login_error" value="{{__('messages.login_error')}}" />
      <input type="hidden" id="forgot_error_2" value="{{__('messages.forgot_error_2')}}">
       <input type="hidden" id="lat_env" value="{{Config::get('mapdetail.lat')}}">
      <input type="hidden" id="long_env" value="{{Config::get('mapdetail.long')}}">
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
   
   
   
   
   
   <script src="https://getuikit.com/assets/uikit/dist/js/uikit.js?nc=6851"></script>
    <script src="https://getuikit.com/assets/uikit/dist/js/uikit-icons.js?nc=6851"></script>
   
   
  <script type="text/javascript" src="{{ URL::to('js/code.js?v=sdsa')}}"></script>
  <script>
  
  </script>
</html>
