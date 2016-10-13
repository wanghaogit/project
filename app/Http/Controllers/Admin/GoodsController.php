<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GoodsController extends Controller
{
    //商品管理后台页面
    public function index(Request $request)
    {
         //1 获得一个连接的对象 
        $db = \DB::table("goods");
        // dd($db);
        //2 封装搜索条件
        $where = [];   
        if($request->has('name')){
            $name = $request->input('name');
            $where['name'] = $name;
            $list = $db->where('goodsName', 'like', "%{$name}%")->paginate(5);//实现过滤 控制器
        }else{
            //3 分页 
            //数据 
            $list = $db->paginate(5);
        }  
        //加载stu目录下的index模板 并且将$list数据添加到list中
        return view("admin.goods.goods")->with(["list"=>$list])->with(["where"=>$where]);
    }

    //2 查看单条 
	public function show($id)
	{

	}
    //3 添加信息
    public function create()
	{
		return view("admin.goods.add");
		// return 4444;
	}

    //4 执行添加 
    public function store(Request $request)
	{
		//获得指定的下标对应的值 

		$data = $request->only("cid","goodsName","shopPrice","Img","goodsStock","isOnsale","desCription");
		//图片信息
		// dd($request->file('Img'));
        if(!$request->has("cid","goodsName","shopPrice","Img","goodsStock","isOnsale","desCription")){
            return back()->with('msg','请输入完整信息');
        }        
		if($request->file("Img")){
            //获取上传信息
            $file = $request->file("Img");
            // dd($file);
            //确认上传的文件是否成功
            if($file->isValid()){
                $picname = $file->getClientOriginalName(); //获取上传原文件名
                $ext = $file->getClientOriginalExtension(); //获取上传文件名的后缀名
                //执行移动上传文件
                
                $filename=time().rand(1000,9999).".".$ext;
                $data['Img'] = $filename;
                $file->move("./phoneImg/",$filename);
            
            }
        }
		// dd($data);
		//2 写入数据库

		$id = \DB::table("goods")->insertGetid($data);//执行添加返回自增ID号
		// dd($id);
		  //3 判断是否添加成功
        if($id>0){
            return redirect("admin/zhuan");
            // return "OK";
        }else{
            return "添加失败";
        }
	}

    //5 修改表单
    public function edit($id)
	{
		// // return "修改表单";
		//  //1 获得需要修改的数据
        $good = \DB::table("goods")->where('id',$id)->first();//获得单条信息
        // dd($good);
  //       //2 加载修改表单
        return view("admin.goods.edit",['vo'=>$good]);
	}

    //6 执行修改 
    public function update(Request $request,$id)
	{
		// return "OK";
		//  //1 接收表单提交的值 
        $data = $request->only("cid","goodsName","shopPrice","Img","goodsStock","isOnsale","desCription");
        // dd($data);
        // //获取上传信息
        $file = $request->file("Img");
        // dd($file);
        // // 确认上传的文件是否成功
        if($file->isValid()){
            $picname = $file->getClientOriginalName(); //获取上传原文件名
            $ext = $file->getClientOriginalExtension(); //获取上传文件名的后缀名
            //执行移动上传文件
            $filename=time().rand(1000,9999).".".$ext;
            $data['Img'] = $filename;
            $file->move("./phoneImg/",$filename);
        }

  //       //2 执行修改 
        \DB::table("goods")->where("id",$id)->update($data);
        // return 555;
  //       //3 跳
        return redirect("/admin/goods");
	}

    //7 执行删除
    public function destroy($id)
	{
		//执行删除
		\DB::table('goods')->where('id',$id)->delete();
		//跳转
		return redirect("admin/goods");
        // return "删除成功";
	}
	// 8执行成功后的跳转
	public function zhuan()
	{
		// return 'lkjlkjlkj';
		return view('admin.goods.zhuan');
	}
}
