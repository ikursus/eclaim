@extends('layouts/app')

@section('kandungan_page')

@include('errors/alerts')

<form method="POST" action="{{ route('updateUser', ['id' => $user->id]) }}">

  {{ csrf_field() }}
  <input type="hidden" name="_method" value="PATCH">

<div class="form-group{{ $errors->first('name', ' has-error') }}">
  <label>Nama User</label>
  <input type="text" name="name" class="form-control" value="{{ $user->name }}">
  <span class="help-block">{{ $errors->first('name') }}</span>
</div>

<div class="form-group{{ $errors->first('username', ' has-error') }}">
  <label>Username</label>
  <input type="text" name="username" class="form-control" value="{{ $user->username }}">
  <span class="help-block">{{ $errors->first('username') }}</span>
</div>

<div class="form-group{{ $errors->first('email', ' has-error') }}">
  <label>Email</label>
  <input type="email" name="email" class="form-control" value="{{ $user->email }}">
  <span class="help-block">{{ $errors->first('email') }}</span>
</div>

<div class="form-group{{ $errors->first('password', ' has-error') }}">
  <label>Password</label>
  <input type="password" name="password" class="form-control" value="">
  <span class="help-block">{{ $errors->first('password') }}</span>
</div>

<div class="form-group{{ $errors->first('phone', ' has-error') }}">
  <label>Phone</label>
  <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
  <span class="help-block">{{ $errors->first('phone') }}</span>
</div>

<div class="form-group{{ $errors->first('designation', ' has-error') }}">
  <label>Designation</label>
  <input type="text" name="designation" class="form-control" value="{{ $user->designation }}">
  <span class="help-block">{{ $errors->first('designation') }}</span>
</div>

<div class="form-group{{ $errors->first('role', ' has-error') }}">
  <label>Role</label>
  <select name="role" class="form-control">
    <option value="admin">Admin</option>
    <option value="user">User</option>
  </select>
  <span class="help-block">{{ $errors->first('role') }}</span>
</div>

<div class="form-group{{ $errors->first('department_id', ' has-error') }}">
  <label>Department</label>
  <select name="department_id" class="form-control">

    @foreach( $departments as $key )

    <option value="{{ $key->id }}">{{ $key->name }}</option>

    @endforeach

  </select>
  <span class="help-block">{{ $errors->first('department_id') }}</span>
</div>

<button type="submit" class="btn btn-primary">Save</button>

</form>
@endsection
