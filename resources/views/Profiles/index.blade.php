@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="https://instagram.fotp1-2.fna.fbcdn.net/vp/3658f2a85a43d34430b5d91474da3078/5DF066C8/t51.2885-19/s320x320/22709172_932712323559405_7810049005848625152_n.jpg?_nc_ht=instagram.fotp1-2.fna.fbcdn.net"
                alt="sample logo" class="rounded-circle w-100">
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <h1>{{ $user->username}}</h1>
                <a href="/p/create">Add new post</a>
            </div>
            <div class="d-flex">
                <div class="pr-5"><strong>{{$user->posts->count()}}</strong> posts</div>
                <div class="pr-5"><strong>200</strong> followers</div>
                <div class="pr-5"><strong>40</strong> following</div>
            </div>
            <div class="font-weight-bold pt-4">{{$user->profile->title}}</div>
            <div>{{$user->profile->description}}</div>
            <div><a href="{{$user->profile->url}}">Ion Varsescu {{$user->profile->url ?? N/A}}</a></div> <!--will show N/A if no url exists-->
        </div>
    </div>
    <div class="row pt-10">
    @foreach ($user->posts as $post)
    <div class="col-4">
            <img src="/storage/{{ $post->image }}"
                class="w-100">
        </div>
    @endforeach
        
        
    </div>
</div>
@endsection