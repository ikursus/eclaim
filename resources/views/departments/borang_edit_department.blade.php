@extends('layouts/app')

@section('kandungan_page')

@include('errors/alerts')

<form method="POST" action="{{ route('updateDepartment', ['id' => $department->id ]) }}">

  {{ csrf_field() }}
  <input type="hidden" name="_method" value="PATCH">

<div class="form-group{{ $errors->first('name', ' has-error') }}">
  <label>Nama Department</label>
  <input type="text" name="name" class="form-control" value="{{ $department->name }}">
  <span class="help-block">{{ $errors->first('name') }}</span>
</div>

<button type="submit" class="btn btn-primary">Save</button>

</form>
@endsection
