<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    //这个方法只应该在接口顺利完成了对请求业务的处理之后调用
    public function response($code=200,$data=[], $msg=null)
    {
        return response()->diyjson($code, $data, $msg);
    }

}
