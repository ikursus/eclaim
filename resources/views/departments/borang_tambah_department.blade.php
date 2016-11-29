@extends('layouts/app')

@section('kandungan_page')

@include('errors/alerts')

<form method="POST" action="{{ route('storeDepartment') }}">

  <?php echo csrf_field(); ?>

<div class="form-group{{ $errors->first('name', ' has-error') }}">
  <label>Nama Department</label>
  <input type="text" name="name" class="form-control" value="{{ old('name') }}">
  <span class="help-block">{{ $errors->first('name') }}</span>
</div>

<button type="submit" class="btn btn-primary">Save</button>

</form>
@endsection
