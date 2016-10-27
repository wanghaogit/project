<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

class DingController extends Controller
{
    //订单页面
    public function ding($id)
    {
    	// return 123;
    	// return $id;
    	$data = \DB::table('goodsinfo')
    			->where("id",$id)
    			->select('goodsinfo.*')
    			->get();
    	// dd($data);
    	return view('ding')->with(["data"=>$data]);
    }
 
}
