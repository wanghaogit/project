<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //网站管理后台界面
    public function index()
    {
    	return view("admin.index.index");
    	// return "123456";
    }
}
