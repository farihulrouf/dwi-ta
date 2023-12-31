@extends('user.subindex')

@section('metadata')
       <meta property="og:type" content="website"/>
       <meta property="og:url" content="{{$itemdetails->menu_name}}"/>
       <meta property="og:title" content="{{$itemdetails->menu_name}}"/>
       <meta property="og:image" content="{{asset('public/upload/images/menu_item_icon/'.$itemdetails->menu_image)}}"/>
       <meta property="og:image:width" content="250px"/>
       <meta property="og:image:height" content="250px"/>
       <meta property="og:site_name" content="{{$itemdetails->menu_name}}"/>
       <meta property="og:description" content="{{$itemdetails->description}}"/>
       <meta property="og:keyword" content="{{__('messages.metakeyboard')}}"/>
       <link rel="shortcut icon" href="{{asset('public/upload/favicon1.ico')}}">
      <meta name="viewport" content="width=device-width, initial-scale=1">
@stop
@section('content')
<?php 
   function readMoreHelper1($story_desc, $chars = 75) {
    $story_desc = substr($story_desc,0,$chars);  
    $story_desc = substr($story_desc,0,strrpos($story_desc,' '));  
    $story_desc = $story_desc."...";  
    return $story_desc;  
   }
   function headreadMoreHelper1($story_desc, $chars =75) {
    $story_desc = substr($story_desc,0,$chars);  
    $story_desc = substr($story_desc,0,strrpos($story_desc,' '));  
    return $story_desc;  
   }  
   
   ?>
   
<div class="container detail-section-2">
   <div class="row">
      @if(Session::has('message'))
      <div class="col-sm-12">
         <div class="alert  {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show" role="alert">{{ Session::get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
      </div>
      @endif
      <div class="col-lg-5 col-md-5 col-sm-6 col-12">
         <img src="{{asset('public/upload/images/menu_item_icon/'.$itemdetails->menu_image)}}" class="img-fluid detail-product-img" alt="{{__('messages.res_image')}}" style="border-radius: 5px;
">
      </div>
      <input type="hidden" name="item_id" id="item_id" value="{{$itemdetails->id}}" />
      <input type="hidden" name="menu_name" id="menu_name" value="{{$itemdetails->menu_name}}"/>
      <div class="col-lg-7 col-md-7 col-sm-6 col-12">
         <div class="detail-product-box">
            <div class="detail-descri">
                <input type="hidden" id="selectedsize" name="selectedsize" value="{{$sized}}"/>
               <div class="detail-product-head">
                  <h4>{{$itemdetails->menu_name}}</h4>
                  @if($sized=='s')
                    <p>{{$curreny}}<span id="price">{{$itemdetails->small_price}}</span></p>
                    <input type="hidden" id="origin_price" name="origin_price" value="{{$itemdetails->small_price}}" />
                  @elseif($sized=='m')
                    <p>{{$curreny}}<span id="price">{{$itemdetails->medium_price}}</span></p>
                    <input type="hidden" id="origin_price" name="origin_price" value="{{$itemdetails->medium_price}}" />
                  @else
                    <p>{{$curreny}}<span id="price">{{$itemdetails->large_price}}</span></p>
                    <input type="hidden" id="origin_price" name="origin_price" value="{{$itemdetails->large_price}}" />
                  @endif
                  
               </div>
               <div class="detail-product-content">
                  <p id="descriptionpro">{{$itemdetails->description}}</p>
               </div>
                <div class="size_main_sb">
                    
                   <a href="javascript:changepriceqty1(0,'s','{{$itemdetails->id}}','{{$itemdetails->small_price}}')" class="detaills <?= $sized=='s'?'active':'';?>" id="0s">S</a>
                   <a href="javascript:changepriceqty1(0,'m','{{$itemdetails->id}}','{{$itemdetails->medium_price}}')" class=" detaills <?= $sized=='m'?'active':'';?>" id="0m">M</a>
                   <a href="javascript:changepriceqty1(0,'l','{{$itemdetails->id}}','{{$itemdetails->large_price}}')" class="detaills <?= $sized=='l'?'active':'';?>" id="0l">L</a>
               </div>
               <div class="detail-share-buttons">
                  <div class="detail-facebook">
                     <a href="javascript:shareonsoical(1,'{{$itemdetails->id}}')">
                     <i class="fa fa-facebook-square" aria-hidden="true"></i>
                     <span>{{__('messages.share')}}</span>
                     <span id="facebook_share_id">{{$itemdetails->facebook_share}}</span>
                     </a>
                  </div>
                  <div class="detail-tweet">
                     <a href="javascript:shareonsoical(2,'{{$itemdetails->id}}')">
                     <i class="fa fa-twitter" aria-hidden="true"></i>
                     <span>{{__('messages.tweet')}}</span>
                     <span id="twitter_share_id">{{$itemdetails->twitter_share}}</span>
                     </a>
                  </div>
               </div>
            </div>
            <div class="detail-ingredients">
               <div class="row">
                  <div class="col-lg-6 col-md-6">
                     <div class="detail-ingredients-head detail-ingredients-head-1">
                        <h3>{{__('messages.FI')}}</h3>
                        <table class="minha-table">
                          <tr>
                              <?php $i=0;?>
                           @foreach($menu_interdient1 as $mi)
                              @if($mi->type==0)
                                <td>
                                    <label class="custom-checkbox-label" style="    font-size: 15px;">
                                         {{$mi->item_name}}
                                         ({{$curreny}}
                                             @if($sized=='s')
                                            <span id="in{{$mi->id}}">{{$mi->small_price}}</span> )
                                             @elseif($sized=='m')
                                             <span id="in{{$mi->id}}">{{$mi->medium_price}}</span> )
                                             @else
                                             <span id="in{{$mi->id}}">{{$mi->large_price}}</span> )
                                            )
                                            @endif
                                         <input type="checkbox" id="checkbox-{{$i}}" class="checkbox-custom" name="interdient" value="{{$mi->id}}">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <?php $i++;?>
                             @endif
                           @endforeach
                          </tr>
                        </table>
                     </div>
                  </div>
                  <div class="col-lg-6 col-md-6">
                     <div class="detail-ingredients-head">
                        <h3>{{__('messages.PI')}}</h3>
                        <table class="minha-table minha-table-2">
                          <tr>
                            @foreach($menu_interdient1 as $mi)
                              @if($mi->type==1)
                                <td>
                                    <label class="custom-checkbox-label" style="    font-size: 15px;">
                                         {{$mi->item_name}} 
                                             
                                            ({{$curreny}}
                                             @if($sized=='s')
                                            <span id="in{{$mi->id}}">{{$mi->small_price}}</span> )
                                             @elseif($sized=='m')
                                             <span id="in{{$mi->id}}">{{$mi->medium_price}}</span> )
                                             @else
                                             <span id="in{{$mi->id}}">{{$mi->large_price}}</span>
                                            )
                                            @endif
                                             <input type="checkbox" id="checkbox-{{$i}}" class="checkbox-custom" name="interdient" value="{{$mi->id}}" onclick="addprice('{{$mi->id}}','{{$i}}')">
                                         
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <?php $i++;?>
                             @endif
                           @endforeach
                          </tr>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
            <div class="detail-plus-button min-add-button">
               <div class="input-group">
                  <a data-decrease>
                  <i class="fa fa-minus" aria-hidden="true" onclick="decreaseValue()"></i>
                  </a>
                  <input type="text" id="number" name="qty" value="{{__('messages.qty_pl')}}" />
                  <a data-increase>
                  <i class="fa fa-plus" aria-hidden="true" onclick="increaseValue()"></i>
                  </a>
               </div>
            </div>
            <a href="javascript:addtocart()">
               <div class="detail-plus-add-cart">
                  <span>{{__('messages.addcart')}}</span>
               </div>
            </a>
         </div>
      </div>
   </div>
</div>
<div class="detail-related-box">
   <div class="container">
      <div class="detail-related-head">
         <h3>{{__('messages.realted_pro')}}</h3>
      </div>
      
          <div id="portfoliolistrelatedpro">
               <?php 
                        for($i=0;$i<count($items);$i++){ if($itemdetails->category==$items[$i]->category){?>
                          
                             <?php echo "<div class='row'>";
                             
                             if(isset($items[$i])&&$itemdetails->category==$items[$i]->category){ ?>
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
                                                  <a href="javascript:changepriceqty({{$i}},'s',{{$items[$i]->id}},'{{$items[$i]->small_price}}','r')" id="s{{$i}}r" class="sizename{{$i}}r">S</a>
                                                  <a href="javascript:changepriceqty({{$i}},'m',{{$items[$i]->id}},'{{$items[$i]->medium_price}}','r')" class="active sizename{{$i}}r" id="m{{$i}}r">M</a>
                                                  <a href="javascript:changepriceqty({{$i}},'l',{{$items[$i]->id}},'{{$items[$i]->large_price}}','r')" id="l{{$i}}r" class="sizename{{$i}}r">L</a>
                                               </div>
                                            </div>
                                            <div class="price">
                                               <h1>{{$curreny}}<span id="priceitem{{$i}}r">{{$items[$i]->medium_price}}</span></h1>
                                               <div class="cart">
                                                  <a href="javascript:gotodetail('{{$items[$i]->id}}','{{$i}}')">{{__('messages.addcart')}}</a>
                                               </div>
                                            </div>
                                         </div>
                                      </div>
                                   </div>
                                
                             <?php $i=$i+1;}
                             if(isset($items[$i])&&$itemdetails->category==$items[$i]->category){ ?>
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
                                                  <a href="javascript:changepriceqty({{$i}},'s',{{$items[$i]->id}},'{{$items[$i]->small_price}}','r')" id="s{{$i}}r" class="sizename{{$i}}r">S</a>
                                                  <a href="javascript:changepriceqty({{$i}},'m',{{$items[$i]->id}},'{{$items[$i]->medium_price}}','r')" class="active sizename{{$i}}r" id="m{{$i}}r">M</a>
                                                  <a href="javascript:changepriceqty({{$i}},'l',{{$items[$i]->id}},'{{$items[$i]->large_price}}','r')" id="l{{$i}}r" class="sizename{{$i}}r">L</a>
                                               </div>
                                            </div>
                                            <div class="price">
                                               <h1>{{$curreny}} <span id="priceitem{{$i}}r">{{$items[$i]->medium_price}}</span></h1>
                                               <div class="cart">
                                                  <a href="javascript:gotodetail('{{$items[$i]->id}}','{{$i}}')">{{__('messages.addcart')}}</a>
                                               </div>
                                            </div>
                                         </div>
                                      </div>
                                   </div>
                                 
                             <?php } 
                             echo "</div>"; ?>
                            
                             <?php
                        } } ?>
          </div>
      
   </div>
</div>
</div>
@stop
