<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class LinkController extends Controller
{
    //友情链接+配置+板块（图片）
      public function index(Request $request)
	{	
		//获取配置表数据
		$on = \DB::table("peizhi")->first();
		//获取indexpic表中的数据
		$write = \DB::table("indexpic")->get();
		//  1 获得一个连接的对象 
        $list = \DB::table("links")->get();
        //加载stu目录下的index模板 并且将$list数据添加到list中
		return view("index")->with(['list'=>$list])->with(['on'=>$on])->with(['write'=>$write]);

		//  1 获得一个连接的对象 
        $list = \DB::table("links")->get();
       
        //加载stu目录下的index模板 并且将$list数据添加到list中
		return view("index")->with(['list'=>$list])->with(['on'=>$on]);
	}
}
