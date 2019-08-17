@extends('layouts.app')

@section('content')
<div class="container">
        <form action="/profile/{{$user->id}}" enctype="multipart/form-data" method="post"> <!--we know the action and methdod from here:https://laravel.com/docs/5.1/controllers#restful-resource-controllers-->
           <!--we want to use PATCH to update but the browser doesn't know this method and will default to GET, therefore we use "post" and then we use a special blade directive 
        we use multipart enctype because our form will also upload images, not only simple data
        -->
           
           
            @csrf <!--security measure for laravel, so only our server can send the form-->
            @method('PATCH')
                <div class="row">
                    <div class="col-8 offset-2">
                        <div class="row">
                            <h1>Edit profile</h1>
                        </div>
                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label">Title</label>
        
        
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                name="title" value="{{ old('title') ?? $user->profile->title}}" required autocomplete="title" autofocus>
        <!-- the old('title') brings the data if the form validation fails -->
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
        
                        </div>

                        <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label">Description</label>
            
            
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror"
                                    name="description" value="{{ old('description') ?? $user->profile->description }}" required autocomplete="description" autofocus>
            
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
            
                            </div>

                            <div class="form-group row">
                                    <label for="url" class="col-md-4 col-form-label">Url</label>
                
                
                                    <input id="url" type="text" class="form-control @error('url') is-invalid @enderror"
                                        name="url" value="{{ old('url') ?? $user->profile->url }}" required autocomplete="url" autofocus>
                
                                    @error('url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                
                                </div>
                        <div class="row">
                            <label for="image" class="col-md-4 col-form-label">Profile image</label>
                            <input type="file" id="image" name="image"
                                class="form-control-file @error('image') is-invalid @enderror">
                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="row pt-4">
                            <button class="btn btn-primary">Save profile</button>
        
                        </div>
                    </div>
            </form>
</div>
@endsection