@extends('home.base')

@section('content')
    <div class="play-music" data-play="0">
        <audio class="audio" id="music-audio" loop autoplay src="/static/home/audio/music.mp3"></audio>
    </div>
    <div class="content-page">
        <div class="people-img"><img src="/static/home/images/people-img.jpg" alt=""/></div>
        <div class="line-bg"></div>
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
        <div class="words8"><i class="dib"></i></div>
        <!--邀请函-->
        <div class="invitation">
            <div class="stationery1"></div>
            <div class="stationery2"></div>
            <div class="stationery3"></div>
            <div class="stationery4"></div>
            <div class="invitation-icon"><a href="{{route('home.message')}}" class="dib"></a></div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function(){
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
            })

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

        });
    </script>
@endsection