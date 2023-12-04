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
<div class="cart-bill-and-category">
   <div class="container">
      <div class="cart-head">
         <h1>{{__('messages.cart')}}</h1>
      </div>
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
         <div class="col-lg-8">
            <div class="container">
               <div class="cart-category">
                  <div class="row">
                     <table class="table table-image table-striped">
                        <thead class="cart-quantity-heading">
                           <tr class="cart-category-head">
                              <th scope="col" class="cart-category-tab">
                              </th>
                              <th scope="col" class="cart-category-tab">
                              </th>
                              <th scope="col" class="cart-category-tab">
                                 {{__('messages.product')}}
                              </th>
                              <th scope="col" class="cart-category-tab">
                                 {{__('messages.price')}}
                              </th>
                              <th scope="col" class="cart-category-tab">
                                 {{__('messages.qty')}}
                              </th>
                              <th scope="col" class="cart-category-tab">
                                 {{__('messages.total')}}
                              </th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $cartCollection = Cart::getContent();$i=0;?>
                           @foreach($cartCollection as $item)
                           <tr class="cart-box-items">
                              <th scope="row" class="cart-category-items">
                                 <a href="{{url('deletecartitem/'.$item->id)}}">
                                 <i class="fa fa-trash-o" aria-hidden="true"></i>
                                 </a>
                              </th>
                              <td class="cart-product-image">
                                 @foreach($allmenu as $ai)   
                                 @if($item->name==$ai->menu_name)
                                 <img src="{{asset('public/upload/images/menu_item_icon/'.$ai->menu_image)}}" class="cartth">
                                 @endif 
                                 @endforeach
                              </td>
                              <td class="cart-category-items prod">
                                 <h6>{{__('messages.product')}}:</h6>
                                 <p class="cartitemtxt">  
                                    {{$item->name}} ({{ucfirst($item->attributes[0]['size'])}})
                                 </p>
                                 @foreach($item->attributes[0] as $cartinter)   
                                 @foreach($menu_interdient as $me)
                                 @if($cartinter==$me->id)
                                 <span>
                                 {{$me->item_name}},
                                 </span> 
                                 @endif
                                 @endforeach
                                 @endforeach
                              </td>
                              <td class="cart-category-items">
                                 <h6>{{__('messages.price')}}:</h6>
                                 <p class="cart-category-items-price">
                                    {{$curreny}}<span id="price_pro{{$item->id}}">
                                     {{number_format($item->price, 2, '.', '')}}
                                    </span>
                                 </p>
                              </td>
                              <td class="cart-category-shape">
                                 <h6>{{__('messages.qty')}}:</h6>
                                 <div class="cart-quantity">
                                    <div class="increment">
                                       <div class="button-increment">
                                          <button class="" type="button" value="+" onclick="addqty('{{$item->id}}','{{$i}}')">
                                          <a>
                                          <i class="fa fa-plus" aria-hidden="true">
                                          </i>
                                          </a>
                                          </button>
                                          <input type="text" class="input-text qty" id="adults" name="qty{{$i}}" value="{{$item->quantity}}" readonly />
                                          <button class=" .cart-category .cart-quantity-button" type="button" value="-" onclick="minusqty('{{$item->id}}','{{$i}}')">
                                          <a>
                                          <i class="fa fa-minus" aria-hidden="true">
                                          </i>
                                          </a>
                                          </button>
                                       </div>
                                    </div>
                                 </div>
                              </td>
                              <td class="cart-category-items">
                                 <?php $totalamount=(float)$item->quantity*(float)$item->price;?>
                                 <h6>{{__('messages.total')}}:</h6>
                                 <p class="cart-category-items-price" id="producttotal{{$item->id}}">
                                    {{$curreny}}{{number_format($totalamount, 2, '.', '')}}
                                 </p>
                              </td>
                           </tr>
                           <?php $i++;?>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-4">
            <div class="cart-bill-box">
               <div class="cart-bill-box-head">
                  <h4>
                     {{__('messages.cart_total')}}
                  </h4>
               </div>
               <div class="cart-b-subtotal">
                  <div class="cart-bs-head">
                     <h4>
                        {{__('messages.subtotal')}}
                     </h4>
                      <p>{{$curreny}}<span id="subtotal"><?php echo number_format(Cart::getTotal(), 2, '.', '');?></span></p>
                    
                  </div>
               </div>
               <div class="cart-b-subtotal" id="dcorder">
                  <div class="cart-bs-head">
                     <h4>{{__('messages.DC')}}</h4>
                     <input type="hidden"  id="delivery_charges" value="{{number_format($delivery_charges, 2, '.', '')}}"/>
                     <p>{{$curreny}}<span id="delivery_charges_order">{{number_format($delivery_charges, 2, '.', '')}}</span></p>
                  </div>
               </div>
               <div class="cart-b-subtotal">
                  <div class="cart-bs-head cart-bs-ftotal">
                     <h4>{{__('messages.total')}}</h4>
                     <p class="cartfinaltotal" >{{$curreny}}
                     <span id="finaltotal">
                         <?php
                                $subtotal=Cart::getTotal();
                                $delivery=$delivery_charges;
                                $main_total=$subtotal+$delivery;
                         ?>
                         {{number_format($main_total, 2, '.', '')}}</span>
                     </p>
                  </div>
               </div>
            </div>
            <div class="cart-shipping-box">
               <div class="cart-b-shipping">
                  <div class="cart-bs-heading">
                     <h4>{{__('messages.shipping')}}</h4>
                     {{ Form::open(array('url' => 'checkout')) }}
                        <div class="cart-bs-content">
                          {{ Form::token()}}
                           <p>
                            
                                <label class="custom-checkbox-label">
                                     {{__('messages.HD')}}
                                     <input type="checkbox" id="checkbox-0" class="checkbox-custom" name="delivery_option" checked value="0" onclick="changeoption1(this.value)">
                                    <span class="checkmark"></span>
                                </label>
                           </p>
                           <div class="cart-bs-content-2">
                              <p>
                               
                                  <label class="custom-checkbox-label">
                                     {{__('messages.LP')}}
                                     <input type="checkbox" id="checkbox-1" class="checkbox-custom" name="delivery_option" value="1" onclick="changeoption1(this.value)">
                                    <span class="checkmark"></span>
                                </label>
                              </p>
                           </div>
                        </div>
                        <div class="cart-bsc-note">
                           <p>{{__('messages.ship_sug')}}</p>
                        </div>
                        <div>
                           <button type="submit" class="checkout-but">
                           <span>{{__('messages.btn_checkout')}}</span>
                           </button>
                        </div>
                     {{ Form::close() }}
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@stop
