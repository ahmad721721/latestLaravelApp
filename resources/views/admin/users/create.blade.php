@extends('layouts.admin')
@section('content')
    <h1>Create Admin Users</h1>
{{--files=>true is equivalent to enctype=multipart/form-data --}}
            {!! Form::open(['method'=>'POST', 'action' => 'AdminUsersController@store','files'=>true]) !!}
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
            {!! Form::select('role_id',[''=>'Choose Options'] + $roles ,null, ['class'=>'form-control']) !!}
            </div>
    <div class="form-group">
            {!!   Form::label('is_active','Status', ['class'=>'offset-4']) !!}
            {!!   Form::select('is_active',array(1=>'Active',0=>'Not Active') ,0, ['class'=>'form-control']) !!}
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
            {!!    Form::submit('Create Admin User', ['class'=>'btn btn-primary btn-block']) !!}
               {!! Form::close() !!}
        </div>
    @include('includes.form_errors')
    @endsection
