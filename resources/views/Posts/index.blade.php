@extends ('layouts.app');

@section ('content')
<div class="container">
    <div class="d-flex flex-column align-items-center">
    <h1>Your personal homepage</h1>
    <p>Here you'll see the latest posts from other users you are following</p>
    </div>
    @foreach($posts as $post)
    <div class="row">
        <div class="col-6 offset-3">
        <a href="/profile/{{ $post->user->id}}">
                <img src="/storage/{{$post->image}}" class="w-100">
        </a>
        </div>
    </div>
    <div class="row">
        <div class="col-6 offset-3 pt-2 pb-4">
           
            <p>
                <span class="font-weight-bold">
                    <a href="/profile/{{$post->user->id}}">
                        <span class="text-dark">{{$post->user->username}}</span>
                    </a>
                </span> {{$post->caption}}</p>
        </div>
    </div>
</div>
    @endforeach

    <div class="row">
    <div class="col-12 d-flex justify-content-center">
{{$posts->links()}} <!--we can use "links()" because we used "paginate()" in the controller-->
    </div>
    </div>
</div>
@endsection