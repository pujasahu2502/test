@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <a class="btn btn-info pull-rigth" href="{{ route('post.index') }}">Post List</a>

            <div class="card">
                <div class="card-header">
                    <h3>{{$post_data[0]->title}}</h3>
                </div>
                <div class="card-body">
                    <img src="{{asset('/')}}/storage/app/{{$post_data[0]->featured_image}}" style="width:690px;height:400px;">
                    <br>
                    <div>
                       <h4>Description</h4>
                       <hr> 
                      <p> {{$post_data[0]->description}}</p>  
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection