@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="{{$user->profile->profileImage()}}"
                alt="sample logo" class="rounded-circle w-100">
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-center pb-3">
                <div class="h4">{{ $user->username}}</div>
                <follow-button user-Id="{{$user->id}}" follows="{{ $follows }}"></follow-button>  <!--this is a vue component, we are passing user_id as props to the component-->
                </div>
                @can('update',$user->profile)<!--we'll show the Add post link only to the user that can also update his profile, user2 can't update user1's profile, therefore ha can't see on user1's profile page the Add post link-->
                <a href="/p/create">Add new post</a>
                @endcan
            </div>
            <!-- this Blade directive allows us to use the authorization from the policy, only if true will we show what's inside-->
            @can ('update',$user->profile)
            <a href="/profile/{{$user->id}}/edit">Edit profile</a>
            @endcan

            <div class="d-flex">
                {{-- We want to refactor these lines because we want to use the cache in laravel - we decided that we want to update the numbers only once in every 30 seconds
                    that is why we moved this logic in the ProfilesController
                <div class="pr-5"><strong>{{$user->posts->count()}}</strong> posts</div>
                <div class="pr-5"><strong>{{$user->profile->followers->count()}}</strong> followers</div>
                <div class="pr-5"><strong>{{$user->following->count()}}</strong> following</div>

 --}}
                <div class="pr-5"><strong>{{ $postCount }}</strong> posts</div>
                <div class="pr-5"><strong>{{ $followersCount }}</strong> followers</div>
                <div class="pr-5"><strong>{{ $followingCount }}</strong> following</div>
            </div>
            <div class="font-weight-bold pt-4">{{$user->profile->title}}</div>
            <div>{{$user->profile->description}}</div>
            <div><a href="{{$user->profile->url}}">Ion Varsescu {{$user->profile->url ?? 'N/A'}}</a></div> <!--will show N/A if no url exists-->
        </div>
    </div>
    <div class="row pt-10">
    @foreach ($user->posts as $post)
    <div class="col-4 pb-4">
        <a href="/p/{{$post->id}}">
            <img src="/storage/{{ $post->image }}"
                class="w-100">
        </a>
        </div>
    @endforeach
        
        
    </div>
</div>
@endsection