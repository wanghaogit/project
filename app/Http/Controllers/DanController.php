<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

class DanController extends Controller
{
    //添加订单
    public function store(Request $request)
    {
    	// return 123;
        // return $request;
          $data = $request->only("sxid","goodsnumber","yhid","dizhi","shouHuoM","shouHuoDH","goodsPrice");
      
          // dd($data);
           $id = \DB::table("details")->insert($data);
            if($id>0){
            return view("Zhifu",["list"=>$data]);
                // return "OK";
            }else{
                return "添加失败";
            }
    	
    }
    //支付
    public function zhifu($id)
    {
        // dd($id);
        $data = \DB::table("details")->where("sxid",$id)->update(["state"=>1]);
       return "支付成功";
    }

}
