@extends('layouts.admin')
@section('content')
    <h1>Create Post</h1>
    <div class="row">

        {!! Form::open(['method'=>'POST', 'action' => 'AdminPostsController@store','files'=>true]) !!}
    <div class="form-group">
        {!! Form::label('title','Title', ['class'=>'offset-4']) !!}
        {!! Form::text('title', null, ['class'=>'form-control']) !!}
    </div>
        <div class="form-group">
        {!! Form::label('category_id','Category', ['class'=>'offset-4']) !!}
        {!! Form::select('category_id', array(0=>'php',1=>'mysqli'),null, ['class'=>'form-control']) !!}
        </div>
    <div class="form-group">
        {!! Form::label('photo_id','Photo', ['class'=>'offset-4']) !!}
        {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('body','Description', ['class'=>'offset-4']) !!}
        {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
    </div>

    {{csrf_field()}}

    <div class="form-group">
        {!! Form::submit('Create Post', ['class'=>'btn btn-primary btn-block']) !!}
        {!! Form::close() !!}
    </div>
  </div>
    <div class="row">
        @include('includes.form_errors')
    </div>

@endsection
