<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Session;
use App\Setting;

use App\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
     public function __construct(){
     Session::put("current_year",date("Y"));
   	  $store=Setting::find(1);
   	  Session::put("facebook",$store->facebook_id);
   	  Session::put("twitter",$store->twitter_id);
   	  Session::put("linkedin",$store->linkedin_id);
   	  Session::put("google_plus_id",$store->google_plus_id);
   	  Session::put("whatsapp",$store->whatsapp);
   	  Session::put("address",$store->address);
   	  Session::put("email",$store->email);
   	  Session::put("phone",$store->phone);
      Session::put("playstore",$store->play_store_url);
      Session::put("appstore",$store->app_store_url);
      Session::put("stripe_key",$store->stripe_key);
      Session::put("stripe_secret",$store->stripe_secret);
      Session::put("paypal_client_id",$store->paypal_client_id);
      Session::put("paypal_client_secret",$store->paypal_client_secret);
       Session::put("paypal_client_secret",$store->paypal_client_secret);
      Session::put("is_rtl",$store->is_rtl);
      $getcurrency=User::find(1);
        $arr=explode("-",$getcurrency->currency);
        Session::put("usercurrency",$arr[1]);       
        $setting=Setting::find(1);
        Session::put("orderstatus",$setting->order_status);
     }
     
}
