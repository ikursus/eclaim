@extends('layouts/app')

@section('kandungan_page')

@include('errors/alerts')

<form method="POST" action="<?php echo url()->current(); ?>">

  <?php echo csrf_field(); ?>

<div class="form-group{{ $errors->first('title', ' has-error') }}">
  <label>Tajuk Claim</label>
  <input type="text" name="title" class="form-control" value="{{ old('title') }}">
  <span class="help-block">{{ $errors->first('title') }}</span>
</div>

<div class="form-group">
  <label>Tarikh Mula</label>
  <input type="date" name="tarikh_mula" class="form-control" value="{{ old('tarikh_mula') }}">
</div>

<div class="form-group">
  <label>Tarikh Tamat</label>
  <input type="date" name="tarikh_tamat" class="form-control" value="{{ old('tarikh_tamat') }}">
</div>

<div class="form-group">
  <label>Claim Amount</label>
  <input type="text" name="claim_amount" class="form-control" value="{{ old('claim_amount') }}">
</div>

<div class="form-group">
  <label>Nota</label>
  <textarea name="notes" class="form-control">{{ old('notes') }}</textarea>
</div>

<button type="submit" class="btn btn-primary">Hantar Claim</button>

</form>
@endsection
