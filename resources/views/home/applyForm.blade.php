<!DOCTYPE html>
<html data-layout="100*750">
<head>
    <meta charset="utf-8">
    <meta http-equiv = "X-UA-Compatible" content = "IE=edge,chrome=1" />
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <title>小顶金融双12贴息盛宴</title>
    <script src="/static/home/js/zepto.min.js"></script>
    <script type="text/javascript" src="/static/home/js/autoSize.js"></script>
    <link rel="stylesheet" href="/static/home/css/animate.min.css" />
    <link rel="stylesheet" href="/static/home/css/custom.css" />
    <link rel="stylesheet" href="/static/home/css/main.css" />
    <link rel="stylesheet" href="/static/home/css/active.css" />
</head>
<body data-layout="100*750">
<div class="play-music" data-play="0">
    <audio class="audio" id="music-audio" loop autoplay src="/static/home/audio/music.mp3"></audio>
</div>
<section class="swiper-container">
    <section class="swiper-wrapper">
        <!--第一页 start-->
        <section class="swiper-slide first-page">
            <div class="people-img"><img src="/static/home/images/people.png" alt=""/></div>
            <div class="words-group-piece">
                <div class="words-group">
                    <i class="dib words1"></i>
                    <i class="dib words2"></i>
                    <i class="dib words3"></i>
                    <i class="dib words4"></i>
                    <i class="dib words5"></i>
                    <i class="dib words6"></i>
                    <i class="dib words7"></i>
                </div>
                <div class="logo-icon"><i class="dib"></i></div>
            </div>
        </section>
        <!--第一页 end-->
        <!--第二页 start-->
        <section class="swiper-slide second-page">
            <div class="logo-img"></div>
            <div class="tit"></div>
            <div class="time-word"></div>
            <ul class="serve-cont">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
            <div class="prompt-word"></div>
            <div class="phone"></div>
        </section>
        <!--第二页 end-->
        <!--第三页 start-->
        <section class="swiper-slide third-page">
            <div class="logo-img"></div>
            <div class="tit"></div>
            <div class="time-word"></div>
            <form  action="" class="rob-place">
                <div class="input-group">
                    <p class="tit">所在城市：</p>
                    <select name="city" id="city">
                        <option value="0">请选择城市</option>
                        <option value="成都">成都</option>
                        <option value="重庆">重庆</option>
                        <option value="北京">北京</option>
                        <option value="武汉">武汉</option>
                        <option value="广州">广州</option>
                        <option value="深圳">深圳</option>
                        <option value="杭州">杭州</option>
                    </select>
                </div>
                <div class="input-group">
                    <p class="tit">你的电话：</p>
                    <input id="phone" type="tel" placeholder="必填" name="phone" onkeyup="this.value=this.value.replace(/\D/g,'')"/>
                </div>
                <div class="input-group">
                    <p class="tit">你的名字：</p>
                    <input id="name" type="text" placeholder="必填" name="name" />
                </div>
                <div class="input-group">
                    <p class="tit">签约顾问工号：</p>
                    <input id="username" type="text" placeholder="选填" onkeyup="this.value=this.value.replace(/\D/g,'')" name="username"/>
                </div>
                <a href="javascript:void(0);" class="db apply-btn">点我抢名额</a>
            </form>
            <div class="prompt-word"></div>
            <div class="phone"></div>
        </section>
        <!--第三页 end-->
    </section>
    <!--抢名额成功 start-->
    <div class="success-piece">
        <div class="mask"></div>
        <div class="pop-cont">
            <a href="javascript:void(0);" class="dib sure-btn">确定</a>
        </div>
    </div>
    <!--抢名额成功 end-->
</section>
<script src="/static/layui/layui.js"></script>
<script src="/static/home/js/swiper.min.js"></script>
<script src="/static/home/js/touch.js"></script>
<script>
    $(function(){
        $(".swiper-container").height($(window).height());
        var swiper = new Swiper ('.swiper-container', {
            direction: 'vertical',
            speed:300,
            autoplay : 9000,
            autoplayStopOnLast: true,
            autoplayDisableOnInteraction: false,
            loop : false
        });
        //music
        var musicEle = $(".play-music");
        musicEle.on("tap",function(){
            var dataPlay = musicEle.attr("data-play");
            if(dataPlay==0){
                $(".audio")[0].pause();
                musicEle.addClass("stop");
                musicEle.attr("data-play","1");
            }else{
                $(".audio")[0].play();
                musicEle.attr("data-play","0");
                musicEle.removeClass("stop");
            }
        });
        function audioAutoPlay(id){
            var audio = document.getElementById(id);
            audio.play();
            document.addEventListener("WeixinJSBridgeReady", function () {
                audio.play();
            }, false);
            document.addEventListener('YixinJSBridgeReady', function() {
                audio.play();
            }, false);
        }
        audioAutoPlay('music-audio');
        //input 聚焦样式
        var inputEle = $(".input-group>input"),
            successEle = $(".success-piece"),
            ruleEle = $(".active-rule-pop");
        inputEle.focus(function(){
            $(this).addClass("active");
        });
        inputEle.blur(function(){
            $(this).removeClass("active");
        });
        //抢名额成功 弹框
        /*
        $(".apply-btn").click(function(){
            successEle.show();
        });
        */
        $(".success-piece>.mask").click(function(){
            successEle.hide();
        });
        $(".success-piece .sure-btn").click(function(){
            successEle.hide();
        });
    });
    $(window).resize(function(){
        $(".swiper-container").height($(window).height());
    })


    layui.use(['layer'],function () {
        var layer = layui.layer
        var form = layui.form
        $(".apply-btn").click(function(){
            //successEle.show();
            var city = $("#city").val();
            var name = $("#name").val();
            var phone = $("#phone").val();
            var username = $("#username").val();
            if (city==0){
                layer.msg("请选择城市")
                return false;
            }
            if (!/^(1)[3,4,5,7,8][0-9]{9}$/.test(phone)){
                layer.msg("请填写正确的电话")
                return false;
            }
            if (!/^[\u4e00-\u9fa5]{1,}$/.test(name)){
                layer.msg("请填写合法的名字")
                return false;
            }
            $.post("{{route('home.apply')}}",{city:city,name:name,phone:phone,username:username,_token:'{{csrf_token()}}' },function (data) {
                if (data.code==0){
                    $("#name").val('');
                    $("#phone").val('');
                    $("#username").val('');
                    $(".success-piece").show();
                }else {
                    layer.msg(data.msg);
                }
            })
        });
    })

</script>
</body>
</html>


