@extends('layouts/app')

@section('kandungan_page')

@include('errors/alerts')


  {!! Form::open( ['route' => 'storeDepartment'] ) !!}



<div class="form-group{{ $errors->first('name', ' has-error') }}">

  {!! Form::label('name', 'Nama Department') !!}

  {!! Form::text('name', null, ['class' => 'form-control']) !!}

  <span class="help-block">{{ $errors->first('name') }}</span>

</div>

<button type="submit" class="btn btn-primary">Save</button>

{!! Form::close() !!}
@endsection
