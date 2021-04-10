<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Sentinel;
use Session;
use DataTables;
use App\User;
use App\Order;
use App\AppUser;
use App\Delivery;
use App\Setting;
use Cart;
use App\Category;
use App\Item;
use App\Ingredient;
use Hash;
class Cartcontroller extends Controller {
  
    public function addcart($id){
       $item_data=Item::where("menu_name",$id)->first();   
       $id=rand(10,100);
       Cart::add($id, $item_data->menu_name,$item_data->price,1, array());
       return redirect("/");
    }
    public function addcartitem(Request $request){
    	 $totalint=array();
    	 $total=array();
      if($request->get("totalint")!=0){
        $totalint=explode(",",$request->get("totalint")); 
        foreach ($totalint as $k) {
            $dt=Ingredient::where("id",$k)->first();
            if($request->get("size")=='s'){
              $total[]=$dt->small_price;
            }elseif($request->get("size")=='m'){
              $total[]=$dt->medium_price;
            }elseif($request->get("size")=='l'){
              $total[]=$dt->large_price;
            }
            
        }
      } 
      $item_data=Item::where("menu_name",$request->get("id"))->first();
      $id=rand(10,100);
      $priceitem=0;
      if($request->get("size")=='s'){
          $priceitem=$item_data->small_price;
      }elseif($request->get("size")=='m'){
          $priceitem=$item_data->medium_price;
      }elseif($request->get("size")=='l'){
          $priceitem=$item_data->large_price;
      }
      $qty=$request->get("qty");
      $price=$priceitem+array_sum($total);
      $data=array("inter"=>$totalint,"size"=>$request->get("size"));
      Cart::add($id, $item_data->menu_name,$price,$qty, array($data));      
      $cartCollection = Cart::getContent();
      Session::flash('message', __('messages.item_success')); 
      Session::flash('alert-class', 'alert-success');
      return $cartCollection->count();
    }


    public function managecart(){
    
      $data=array();
      $finalresult=array();
      $result=array();
      $cartCollection = Cart::getContent();
      //echo "<pre>";print_r($cartCollection);exit;
      foreach ($cartCollection as $ke) {
           $getmenu=Item::where("menu_name",$ke->name)->first();
           $result['ItemId']=(string)isset($getmenu->id)?$getmenu->id:0;
           $result['ItemName']=(string)$ke->name;
           $result['ItemQty']=(string)$ke->quantity;
           $result['ItemAmt']=(string)$ke->price;
           $totalamount=(float)$ke->quantity*(float)$ke->price;
           $result['ItemTotalPrice']=(string)round($totalamount,2);
           $result['ItemSize']=$ke->attributes[0]['size'];
           $ingredient=array();
           
          foreach ($ke->attributes[0]['inter'] as $val) {
               $ls=array();
                 $inter=Ingredient::find($val);
                 $ls['id']=(string)$inter->id;
                 $ls['category']=(string)$inter->category;
                 $ls['item_name']=(string)$inter->item_name;
                 $ls['type']=(string)$inter->type;
                 if($ke->attributes[0]['size']=='s'){
                     $ls['price']=(string)$inter->small_price;
                 }elseif($ke->attributes[0]['size']=='m'){
                     $ls['price']=(string)$inter->medium_price;
                 }else{
                     $ls['price']=(string)$inter->large_price;
                 }
                 $ls['menu_id']=(string)$inter->menu_id;
                 $ingredient[]=$ls;
          }
          $result['Ingredients']=$ingredient;
          $finalresult[]=$result;
      }
      $data=array("Order"=>$finalresult);
      print_r(json_encode($data));
    }

    public function deletecart($id){
       Cart::remove($id);
       $cartCollection = Cart::getContent();
       if(count($cartCollection)!=0){
           return redirect()->back();
       }
       else{
          return redirect("/");
       }
    }

    public function cartupdate($id,$qty,$op){
        $setting=Setting::find(1);
        if($op==1){//add qty
           Cart::update($id, array('quantity' =>1));
        }
        if($op==0){//minus qty
          Cart::update($id, array('quantity' => -1));
        }
        $cartCollection = Cart::getContent();
                      $totalamountarr=array();
                     foreach ($cartCollection as $car) {
                       $totalamount="";
                       $totalamount=(float)$car->quantity*(float)$car->price;
                       $totalamountarr[]=round($totalamount,2);
        }
       $subtotal=array_sum($totalamountarr);
        $finalresult=(float)array_sum($totalamountarr);
        $data=array("subtotal"=>number_format($subtotal, 2, '.', ''),"finaltotal"=>number_format($finalresult, 2, '.', ''));
        return $data;
        
    }
  
}


