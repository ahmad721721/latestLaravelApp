@extends('layouts.admin')
@section('content')
    <h1>Posts</h1>
    <table class="table table-striped">
        <thead>
          <tr>
            <th>Photo</th>
            <th>Title</th>
            <th>Post Owner</th>
            <th>Category ID</th>
            <th>Body</th>
            <th>Created At</th>
            <th>Updated At</th>
          </tr>
        </thead>
        <tbody>
        @if($posts)
            @foreach($posts as $post)
          <tr>
            <td><img height="100" width="75" src="{{$post->photo ? url($post->photo->file):'http//placehold.it/400x400'}}" alt=""></td>
            <td>{{$post->title}}</td>
            <td>{{$post->user->name}}</td>
            <td>{{$post->category_id}}</td>
            <td>{{$post->body}}</td>
            <td>{{$post->created_at->diffForhumans()}}</td>
            <td>{{$post->updated_at->diffForhumans()}}</td>
          </tr>
          @endforeach
            @endif
        </tbody>
      </table>
@endsection
