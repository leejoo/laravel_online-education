<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    //�������ֻӦ���ڽӿ�˳������˶�����ҵ��Ĵ���֮�����
    public function response($code=200,$data=[], $msg=null)
    {
        return response()->diyjson($code, $data, $msg);
    }

}
