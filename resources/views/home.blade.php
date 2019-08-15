@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="https://instagram.fotp1-2.fna.fbcdn.net/vp/3658f2a85a43d34430b5d91474da3078/5DF066C8/t51.2885-19/s320x320/22709172_932712323559405_7810049005848625152_n.jpg?_nc_ht=instagram.fotp1-2.fna.fbcdn.net"
                alt="sample logo" class="rounded-circle w-100">
        </div>
        <div class="col-9 pt-5">
            <div>
                <h1>{{ $user->username}}</h1>
            </div>
            <div class="d-flex">
                <div class="pr-5"><strong>125</strong> posts</div>
                <div class="pr-5"><strong>200</strong> followers</div>
                <div class="pr-5"><strong>40</strong> following</div>
            </div>
            <div class="font-weight-bold pt-4">{{$user->profile->title}}</div>
            <div>{{$user->profile->description}}</div>
            <div><a href="{{$user->profile->url}}">Ion Varsescu {{$user->profile->url ?? N/A}}</a></div> <!--will show N/A if no url exists-->
        </div>
    </div>
    <div class="row pt-10">
        <div class="col-4">
            <img src="https://instagram.fotp1-2.fna.fbcdn.net/vp/6be5d29f6b7f5c59a7842e15760f6e71/5DE9D44A/t51.2885-15/e35/c0.2.751.751a/s320x320/69095403_212234716426916_3447102072665452317_n.jpg?_nc_ht=instagram.fotp1-2.fna.fbcdn.net"
                class="w-100">
        </div>
        <div class="col-4">
            <img src="https://instagram.fotp1-2.fna.fbcdn.net/vp/62d08f4b842edcff9d86388c37dfa8da/5DEA477F/t51.2885-15/e35/c0.107.925.925a/s240x240/61555594_471501460067844_6848849947845320953_n.jpg?_nc_ht=instagram.fotp1-2.fna.fbcdn.net"
                class="w-100">
        </div>
        <div class="col-4">
            <img src="https://instagram.fotp1-2.fna.fbcdn.net/vp/28974f3602c1c17142ed9813a8ed7b8a/5DEFF206/t51.2885-15/e35/c0.81.887.887/s240x240/66420383_162375928225341_762635906960426989_n.jpg?_nc_ht=instagram.fotp1-2.fna.fbcdn.net"
                class="w-100">
        </div>
    </div>
</div>
@endsection