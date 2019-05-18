@extends('app')
@section('title', 'Login Page Masbro')
@section('content')
<div class="row col-md-12">
    <form class="col-md-6" method="post" action="{{ url('file_upload') }}" enctype="multipart/form-data">

        @if(Session::has('message'))
            @foreach(Session::get('message')  as $value)
            <p class="alert alert-warning">{{ $value }}</p>
            @endforeach
        @endif

        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input style="height: 45px" type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" required>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input style="height: 45px" type="text" name="username" class="form-control" id="username" placeholder="Enter username" required>
        </div>
        <div class="custom-file">
            <label for="exampleFormControlFile1">Example file input</label>
            <input type="file" class="form-control-file" name="image" id="exampleFormControlFile1">
        </div>
        <div><br/>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection