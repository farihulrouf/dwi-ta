<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Sentinel;
use Session;
use DataTables;
use App\User;
use App\Category;
use App\Item;
use App\Ingredient;
use Hash;
use Cart;
use App\Setting;
use App\Order;
use App\Contact;
use App\City;
use App\OrderResponse;
use Artisan;
use Share;
class frontController extends Controller {
    
    public function __construct(){
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
      Session::put("orderstatus",$store->order_status);
      Session::put("main_color",$store->main_color);
      Session::put("combination_color",$store->combination_color);
      Session::put("heading_color",$store->heading_color);
      Session::put("description_color",$store->description_color);
      Session::put("white_color",$store->white_color);
      $getcurrency=User::find(1);
      $arr=explode("-",$getcurrency->currency);
      Session::put("usercurrency",$arr[1]);  
      Session::put("logo",asset("upload/web/").'/'.$store->logo);
      Session::put("main_banner",asset("upload/web/").'/'.$store->main_banner);
      Session::put("second_sec_img",asset("upload/web/").'/'.$store->second_sec_img);
      Session::put("secong_icon_img",asset("upload/web/").'/'.$store->secong_icon_img);
      Session::put("footer_up_img",asset("upload/web/").'/'.$store->footer_up_img);
      Session::put("footer_img",asset("upload/web/").'/'.$store->footer_img);
    }
    
    public function getitemdetails($id,$fields){
         $inter=Ingredient::find($id);
         if($inter){
             if($fields=='s'){
                 return $inter->small_price; 
             }else if($fields=='m'){
                 return $inter->medium_price; 
             }else{
                 return $inter->large_price; 
             }
         }
         return 0;
    }
    public function itemchanges(Request $request){
        $allprice=explode(",",$request->get("totalint"));
        $total=array();
        if($allprice){
            foreach ($allprice as $k) {
                $dt=Ingredient::where("id",$k)->first();
                if($dt){
                    if($request->get("size")=='s'){
                      $total[]=$dt->small_price;
                    }elseif($request->get("size")=='m'){
                      $total[]=$dt->medium_price;
                    }elseif($request->get("size")=='l'){
                      $total[]=$dt->large_price;
                    }
                }
           }
        }
        $data=Ingredient::where("menu_id",$request->get("id"))->get();
        $arr=array("total"=>array_sum($total),"item"=>$data);
        return json_encode($arr);
    }
    
   public function index(){    
      $image_path = __DIR__."/bootstrap/cache/config.php";
      if(file_exists($image_path)) {
            try {
                    unlink($image_path);
                     Artisan::call('config:cache');
            }catch(Exception $e) {
                              
            }                        
      }
       
      $getcurrency=User::find(1);
      $arr=explode("-",$getcurrency->currency);
      Session::put("usercurrency",$arr[1]);        
   	  $category=Category::where("is_deleted",'0')->get();
   	  $item=Item::with('categoryitem')->orderby('category')->where("is_deleted",'0')->get();
      foreach ($item as $k) {
           $menu_name=substr($k->menu_name,0,25);
           if($menu_name!=""){
              $k->menu_name=$menu_name;
           }
      }
   	  $inter=Ingredient::all();
      $allmenu=Item::all();
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
      Session::put("orderstatus",$store->order_status);
      Session::put("main_color",$store->main_color);
      Session::put("combination_color",$store->combination_color);
      Session::put("heading_color",$store->heading_color);
      Session::put("description_color",$store->description_color);
      Session::put("white_color",$store->white_color);
      Session::put("logo",asset("upload/web/").'/'.$store->logo);
      Session::put("main_banner",asset("upload/web/").'/'.$store->main_banner);
      Session::put("second_sec_img",asset("upload/web/").'/'.$store->second_sec_img);
      Session::put("secong_icon_img",asset("upload/web/").'/'.$store->secong_icon_img);
      Session::put("footer_up_img",asset("upload/web/").'/'.$store->footer_up_img);
      Session::put("footer_img",asset("upload/web/").'/'.$store->footer_img);
      $getcurrency=User::find(1);
      $arr=explode("-",$getcurrency->currency);
      return view("user.index")->with("curreny",$arr[1])->with("category",$category)->with("items",$item)->with("ingredient",$inter)->with("allmenu",$allmenu)->with("setting",$store);
   }

   

   public function detailitem($item_id,$size){
      $category=Category::where("is_deleted",'0')->get();
      $itemdetails=Item::find($item_id);
      $item=Item::with('categoryitem')->where("category",$itemdetails->category)->where("is_deleted",'0')->get();
      $inter=Ingredient::where("menu_id",$item_id)->where("is_deleted",'0')->get();
      $allmenu=Item::all();
      $inter1=Ingredient::all();
      $itemdata=Item::with('categoryitem')->where("is_deleted",'0')->get();
      $setting=Setting::find(1);
      $getcurrency=User::find(1);
      $arr=explode("-",$getcurrency->currency);
      return view("user.detailitem")->with("curreny",$arr[1])->with("category",$category)->with("itemdetails",$itemdetails)->with("related_item",$item)->with("menu_interdient1",$inter)->with("allmenu",$allmenu)->with("items",$itemdata)->with("menu_interdient",$inter1)->with("sized",$size)->with("setting",$setting);
   }
   
   public function savecontact(Request $request){
       $store=new Contact();
       $store->name=strip_tags(preg_replace('#<script(.*?)>(.*?)</script>#is', '',$request->get("name")));
       $store->email=strip_tags(preg_replace('#<script(.*?)>(.*?)</script>#is', '',$request->get("email")));
       $store->phone=strip_tags(preg_replace('#<script(.*?)>(.*?)</script>#is', '',$request->get("phone")));
       $store->message=strip_tags(preg_replace('#<script(.*?)>(.*?)</script>#is', '',$request->get("message")));
       $store->save();
       Session::flash('message',__('messages.contact_success')); 
       Session::flash('alert-class', 'alert-success');
       return redirect("contactus");
   }
      public function category_list($id){
      $category=Category::all();
      $getcurrency=User::find(1);
      $arr=explode("-",$getcurrency->currency);
      $item=Item::with('categoryitem')->where("category",$id)->where("is_deleted",'0')->get();
      foreach ($item as $k) {
          $k->menu_name=substr($k->menu_name,0,25);
          $k->description=substr($k->description,0,75);
      }
      $data=array("category"=>$category,"item"=>$item);
      return json_encode($data);    
   }
   public function readMoreHelper($story_desc, $chars) {
    $story_desc = substr($story_desc,0,$chars);  
    $story_desc = substr($story_desc,0,strrpos($story_desc,' '));  
    $story_desc = $story_desc."...";  
    return $story_desc;  
  }
  function headreadMoreHelper($story_desc, $chars =75) {
    $story_desc = substr($story_desc,0,$chars);  
    $story_desc = substr($story_desc,0,strrpos($story_desc,' '));  
    $story_desc = $story_desc;  
    return $story_desc;  
}  
   public function sharesoicalmedia($media_id,$item_id){
      $itemget=Item::find($item_id);
      if($media_id==1){
         $itemget->facebook_share=(int)$itemget->facebook_share+1;
         $itemget->save();
         return $itemget->facebook_share;
      }
      if($media_id==2){//twitter
         $itemget->twitter_share=(int)$itemget->twitter_share+1;
         $itemget->save();
         return $itemget->twitter_share;
      }
      
   }
   public function cartdetails(){
       if(Session::get("orderstatus")==0){
           return redirect('/');
       }
      $cartCollection = Cart::getContent();
      if($cartCollection->count()){
            $item_id=1;
            $setting=Setting::find(1);
            $category=Category::where("is_deleted",'0')->get();
            $itemdetails=Item::find($item_id);
            $item=Item::with('categoryitem')->where("is_deleted",'0')->get();
            $inter=Ingredient::all();
            $allmenu=Item::all();
            $getcurrency=User::find(1);
            $arr=explode("-",$getcurrency->currency);
            $itemdata=Item::with('categoryitem')->where("is_deleted",'0')->get();
            return view("user.cartdetails")->with("curreny",$arr[1])->with("setting",$setting)->with("category",$category)->with("itemdetails",$itemdetails)->with("related_item",$item)->with("menu_interdient",$inter)->with("allmenu",$allmenu)->with("delivery_charges",$setting->delivery_charges)->with("items",$itemdata);      
      }else{
             return redirect("/");
      }
   }
   
   public function showaboutus(){
      $category=Category::where("is_deleted",'0')->get();
      $allmenu=Item::all();
      $inter=Ingredient::all();
      $setting=Setting::find(1);
      $getcurrency=User::find(1);
      $arr=explode("-",$getcurrency->currency);
      $item=Item::with('categoryitem')->where("is_deleted",'0')->get();
      return view("user.about")->with("curreny",$arr[1])->with("category",$category)->with("allmenu",$allmenu)->with("menu_interdient",$inter)->with("items",$item)->with("setting",$setting);
       
   }

   public function viewdetails($id){
     if(!Session::get("login_user")){
          return redirect("/");
     } 
     $order=Order::where("id",$id)->where("user_id",Session::get("login_user"))->first();
     if(empty($order)){
        return redirect('myaccount');
     }    
     $itemls=OrderResponse::with('itemdata')->where("set_order_id",$id)->get();
     $category=Category::where("is_deleted",'0')->get();
     $allmenu=Item::all();
     $inter=Ingredient::all();
     $getcurrency=User::find(1);
     $arr=explode("-",$getcurrency->currency);
     $item=Item::with('categoryitem')->where("is_deleted",'0')->get();
     $setting=Setting::find(1);
     return view("user.viewdetails")->with("curreny",$arr[1])->with("category",$category)->with("setting",$setting)->with("allmenu",$allmenu)->with("menu_interdient",$inter)->with("items",$item)->with("order",$order)->with("itemlist",$itemls);
   }
   public function checkout(Request $request){
     if(Session::get("orderstatus")==0){
           return redirect('/');
       }
     if($request->get("delivery_option")==0||$request->get("delivery_option")==1){
         $category=Category::where("is_deleted",'0')->get();
         $allmenu=Item::all();
         $inter=Ingredient::all();
         $setting=Setting::find(1);
         $city=City::where("is_deleted",'0')->get();
         $ip = $_SERVER['REMOTE_ADDR'];
        
         $lat=21.2284231;
         $long=72.896816;
         $getcurrency=User::find(1);
         $arr=explode("-",$getcurrency->currency);
         $item=Item::with('categoryitem')->where("is_deleted",'0')->get();
         return view("user.checkout")->with("curreny",$arr[1])->with("category",$category)->with("allmenu",$allmenu)->with("menu_interdient",$inter)->with("items",$item)->with("shipping",$request->get("delivery_option"))->with("delivery_charges",$setting->delivery_charges)->with("city",$city)->with('latitude',$lat)->with("longtitude",$long)->with("setting",$setting);
     }
     else{
           Session::flash('message', __('messages.shipping_error')); 
           Session::flash('alert-class', 'alert-danger');
           return redirect()->back();
     }
     
   }
   public function showcontactus(){
    $category=Category::where("is_deleted",'0')->get();
    $allmenu=Item::all();
    $inter=Ingredient::all();
    $item=Item::with('categoryitem')->where("is_deleted",'0')->get();
    $setting=Setting::find(1);
    $getcurrency=User::find(1);
    $arr=explode("-",$getcurrency->currency);
    return view("user.contact")->with("curreny",$arr[1])->with("category",$category)->with("allmenu",$allmenu)->with("setting",$setting)->with("menu_interdient",$inter)->with("items",$item);   
   }
   public function showservice(){
     $category=Category::where("is_deleted",'0')->get();
     $allmenu=Item::all();
     $inter=Ingredient::all();
     $setting=Setting::find(1);
     $item=Item::with('categoryitem')->where("is_deleted",'0')->get();
     $getcurrency=User::find(1);
     $arr=explode("-",$getcurrency->currency);
     return view("user.service")->with("curreny",$arr[1])->with("category",$category)->with("setting",$setting)->with("allmenu",$allmenu)->with("menu_interdient",$inter)->with("items",$item);    
   }

   public function termofuse(){
     $category=Category::where("is_deleted",'0')->get();
     $allmenu=Item::all();
     $inter=Ingredient::all();
     $setting=Setting::find(1);
     $item=Item::with('categoryitem')->where("is_deleted",'0')->get();
     $getcurrency=User::find(1);
      $arr=explode("-",$getcurrency->currency);
     return view("user.term")->with("curreny",$arr[1])->with("setting",$setting)->with("category",$category)->with("allmenu",$allmenu)->with("menu_interdient",$inter)->with("items",$item);
   }

    public function myaccount(){
      if(!Session::get("login_user")){
          return redirect("/");
      }
      $category=Category::where("is_deleted",'0')->get();
      $allmenu=Item::all();
      $inter=Ingredient::all();
      $setting=Setting::find(1);
      $item=Item::with('categoryitem')->where("is_deleted",'0')->get();
      $myorder=Order::where("user_id",Session::get("login_user"))->orderby('id','DESC')->get();
      $getcurrency=User::find(1);
      $arr=explode("-",$getcurrency->currency);
      return view("user.myaccount")->with("curreny",$arr[1])->with("setting",$setting)->with("category",$category)->with("allmenu",$allmenu)->with("menu_interdient",$inter)->with("items",$item)->with("myorder",$myorder);
   }
}


