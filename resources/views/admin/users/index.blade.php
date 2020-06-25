@extends('layouts.admin');


@section('content')
    @if(Session::has('deleted_user'))
     <p class="bg-danger">{{session('deleted_user')}}</p>
    @endif
    <h1>Admin Users</h1>
    <table class="table table-striped">
        <thead>
          <tr>
            <th>Id</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Updated At</th>
          </tr>
        </thead>
        <tbody>
        @if($users)
            @foreach($users as $user)
          <tr>
            <td>{{$user->id}}</td>
            <td><img height="120" width="120" src="{{url($user->photo ? $user->photo->file:'no photo')}}" alt=""></td>
            <td><a href="{{route('admin.users.edit',$user->id)}}">{{$user->name}}</a></td>
            <td>{{$user->email}}</td>
            <td>{{$user->role->name}}</td>
            <td>{{$user->is_active == 1 ? 'Active' : 'Not Active'}}</td>
            <td>{{$user->created_at->diffForHumans()}}</td>
            <td>{{$user->updated_at->diffForHumans()}}</td>
          </tr>
          @endforeach
          @endif
        </tbody>
      </table>
    @endsection
