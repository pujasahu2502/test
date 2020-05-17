@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <a class="btn btn-info pull-rigth" href="{{ route('post.index') }}">Post List</a>
     
            <div class="card">
     
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Hello <b>{{auth()->user()->name}}</b> You are logged in!
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
