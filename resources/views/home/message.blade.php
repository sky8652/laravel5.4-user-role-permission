@extends('home.base')

@section('content')
    <div class="content-page second-page">
        <!--活动内容 start-->
        <div class="active-info">
            <p class="tit">Hi，亲爱的你：</p>
            <div class="cont"></div>
            <p class="signature">想你的呱呱</p>
            <div class="hand"><i class="dib"></i></div>
            <a href="{{route('home.applyForm')}}" class="dib git-btn">我要领取</a>
        </div>
        <!--活动内容 end-->
    </div>
@endsection