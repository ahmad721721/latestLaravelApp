@extends('layouts.admin')
@section('content')
    <h1>Edit Admin Users</h1>
    <div class="row">
    <div class="col-sm-3">

        <img src="{{$user->photo ? url($user->photo->file) :'http://placehold.it/400x400'}}" alt="" class="img-responsive ">
    </div>
    <div class="col-sm-9">
    {{--files=>true is equivalent to enctype=multipart/form-data --}}
    {!! Form::model($user, ['method'=>'PATCH', 'action' => ['AdminUsersController@update', $user->id],'files'=>true]) !!}
    <div class="form-group">
        {!!   Form::label('name','Name', ['class'=>'offset-4']) !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!!   Form::label('email','Email', ['class'=>'offset-4']) !!}
        {!! Form::email('email', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!!   Form::label('role_id','Role', ['class'=>'offset-4']) !!}
        {!! Form::select('role_id', $roles ,null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!!   Form::label('is_active','Status', ['class'=>'offset-4']) !!}
        {!!   Form::select('is_active',array(1=>'Active',0=>'Not Active') ,null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!!   Form::label('photo_id','Photo:', ['class'=>'offset-4']) !!}
        {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
    </div>
    {{csrf_field()}}
    <div class="form-group">
        {!!   Form::label('password','Password') !!}
        {!!   Form::password('password',['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!!    Form::submit('Edit Admin User', ['class'=>'btn btn-primary btn-block']) !!}
        {!! Form::close() !!}
    </div>
    </div>
    </div>
    <div class="row">
        @include('includes.form_errors')
    </div>

@endsection
