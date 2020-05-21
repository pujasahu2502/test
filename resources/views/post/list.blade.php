@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        @if((auth()->check() && auth()->user()->hasRole('admin')))
        <a class="btn btn-info pull-rigth" href="{{ route('post.create') }}">Create Post</a>
        @endif
        @if((auth()->check() && auth()->user()->hasRole('editor')))
        <a class="btn btn-info pull-rigth" href="{{ route('post.create') }}">Create Post</a>
        @endif
        <form method="POST" action="{{route('post.filter')}}">
        @csrf
            <input type='text' name="tag" id="tag">
            <button type="submit" class="btn btn-primary">
                {{ __('search') }}
            </button>
        </form>
            <div class="card">
                <div class="card-header">Post List</div>

                <table class="table">
                    <thead>
                        <th>S No.</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Image</th>
                    
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @php
                        $i=1;
                        @endphp
                        @foreach($post_list as $posts)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$posts->title}}</td>
                            <td>{{$posts->description}}</td>
                            <td><img src="{{asset('/')}}/storage/app/{{$posts->featured_image}}" style="width:50px;height:50px;"></td>
                            <td>
                                <form action="{{ route('post.destroy',$posts->slug) }}" method="POST">

                                    <a class="btn btn-info" href="{{ route('post.show',$posts->slug) }}">Show</a>
                                    @if((auth()->check() && auth()->user()->hasRole('admin')))
       
                                    <a class="btn btn-primary" href="{{ route('post.edit',$posts->slug) }}">Edit</a>

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger">Delete</button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                        @php
                        $i++;
                        @endphp
                        @endforeach
                </table>
                {{$post_list->links()}}
            </div>
        </div>
    </div>
</div>
@endsection