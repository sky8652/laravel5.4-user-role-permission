<?php

namespace App\Http\Controllers;

use App\Models\Fan;
class WechatController extends Controller
{
    /*
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {
        $fan = new Fan();
        $wechat = app('wechat');
        $wechat->server->setMessageHandler(function($message) use($fan,$wechat){
            $openid = $message->FromUserName;
            //关注
            if ($message->MsgType=='event' && $message->Event=='subscribe'){
                $user = $wechat->user->get($openid);
                $fan->updateOrCreate(['openid'=>$openid],$user);
            }
            //取消关注
            if ($message->MsgType=='event' && $message->Event=='unsubscribe'){
                $fan->where('openid',$openid)->update(['subscribe'=>0]);
            }
        });
        return $wechat->server->serve();
    }


}
