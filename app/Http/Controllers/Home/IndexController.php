<?php

namespace App\Http\Controllers\Home;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * 活动主页
     */
    public function index()
    {
        return view('home.index');
    }

    /**
     * 信封内容展示
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function message()
    {
        return view('home.message');
    }

    /**
     * 申请表单信息
     */
    public function applyForm()
    {
        return view('home.applyForm');
    }

    public function apply(Request $request)
    {
        $this->validate($request,[
            'name'  => 'required',
            'phone' => 'regex:/^1[34578][0-9]{9}$/',
        ]);
        //是否已购买过
        $customer = Customer::where('phone',$request->get('phone'))->first();
        if ($customer){
            return response()->json(['code'=>200,'msg'=>'您已提交过了']);
        }
        //如果有填写顾问ID，则验证
        if ($request->get('username')){
            $user = User::where('username',$request->get('username'))->first();
            if (!$user){
                return response()->json(['code'=>200,'msg'=>'该顾问不存在，请重新核对']);
            }
        }
        //记录购买记录
        Customer::create($request->all());
        return response()->json(['code'=>0,'msg'=>'您的信息已提交']);

    }



}
