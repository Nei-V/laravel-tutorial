@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/p" enctype="multipart/form-data" method="post"> <!--we know the action and methdod from here:https://laravel.com/docs/5.1/controllers#restful-resource-controllers-->
    @csrf <!--security measure for laravel, so only our server can send the form-->
        <div class="row">
            <div class="col-8 offset-2">
                <div class="row">
                    <h1>Add new post</h1>
                </div>
                <div class="form-group row">
                    <label for="caption" class="col-md-4 col-form-label">Post caption</label>


                    <input id="caption" type="text" class="form-control @error('caption') is-invalid @enderror"
                        name="caption" value="{{ old('caption') }}" required autocomplete="caption" autofocus>

                    @error('caption')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>
                <div class="row">
                    <label for="image" class="col-md-4 col-form-label">Chose image</label>
                    <input type="file" id="image" name="image"
                        class="form-control-file @error('image') is-invalid @enderror">
                    @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="row pt-4">
                    <input type="submit" class="btn btn-primary" value="Add new post">

                </div>
            </div>
    </form>
</div>
@endsection