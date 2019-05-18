@extends('app')
@section('title', 'Login Page Masbro')
@section('content')
<div class="row">
    <table class="table">
        <tr>
            <th>No</th>
            <th>Email</th>
            <th>Username</th>
            <th>Image</th>
            <th>Note</th>
        </tr>
        @foreach($data->data as $key => $value)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $value->email }}</td>
                <td>{{ $value->username }}</td>
                <td><img height="100px" width="100px" src="{{ $value->image }}" /></td>
                <td>
                    @if($value->note)
                        true
                    @else
                        false
                    @endIf
                </td>
            </tr>
        @endForeach
    </table>
</div>
@endsection