@extends('layouts/app')

@section('kandungan_page')

@include('errors/alerts')

{!! Form::open() !!}

<div class="form-group{{ $errors->first('name', ' has-error') }}">
  <label>Nama User</label>
  {!! Form::text('name', null, ['class' => 'form-control']) !!}
  <span class="help-block">{{ $errors->first('name') }}</span>
</div>

<div class="form-group{{ $errors->first('username', ' has-error') }}">
  <label>Username</label>
  {!! Form::text('username', null, ['class' => 'form-control']) !!}
  <span class="help-block">{{ $errors->first('username') }}</span>
</div>

<div class="form-group{{ $errors->first('email', ' has-error') }}">
  <label>Email</label>
  {!! Form::email('email', null, ['class' => 'form-control']) !!}
  <span class="help-block">{{ $errors->first('email') }}</span>
</div>

<div class="form-group{{ $errors->first('password', ' has-error') }}">
  <label>Password</label>
  {!! Form::password('password', ['class' => 'form-control'] ) !!}
  <span class="help-block">{{ $errors->first('password') }}</span>
</div>

<div class="form-group{{ $errors->first('phone', ' has-error') }}">
  <label>Phone</label>
  {!! Form::text('phone', null, ['class' => 'form-control']) !!}
  <span class="help-block">{{ $errors->first('phone') }}</span>
</div>

<div class="form-group{{ $errors->first('designation', ' has-error') }}">
  <label>Designation</label>
  {!! Form::text('designation', null, ['class' => 'form-control']) !!}
  <span class="help-block">{{ $errors->first('designation') }}</span>
</div>

<div class="form-group{{ $errors->first('role', ' has-error') }}">
  <label>Role</label>
  {!! Form::select('role', array('admin' => 'Admin', 'user' => 'User'), null, ['class' => 'form-control']) !!}
  <span class="help-block">{{ $errors->first('role') }}</span>
</div>

<div class="form-group{{ $errors->first('department_id', ' has-error') }}">
  <label>Department</label>
  {!! Form::select('department_id', $departments->pluck('name', 'id'), null, ['class' => 'form-control']) !!}
  <span class="help-block">{{ $errors->first('department_id') }}</span>
</div>

<button type="submit" class="btn btn-primary">Save</button>

{!! Form::close() !!}
@endsection
