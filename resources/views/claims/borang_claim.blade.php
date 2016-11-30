@extends('layouts/app')

@section('kandungan_page')

@include('errors/alerts')

<form method="POST" action="{{ route('storeClaim') }}">

  <?php echo csrf_field(); ?>

<div class="form-group{{ $errors->first('title', ' has-error') }}">
  <label>Claim Title</label>
  <input type="text" name="title" class="form-control" value="{{ old('title') }}">
  <span class="help-block">{{ $errors->first('title') }}</span>
</div>

<div class="form-group">
  <label>Start Date</label>
  <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}">
</div>

<div class="form-group">
  <label>End Date</label>
  <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}">
</div>

<div class="form-group">
  <label>Claim Amount</label>
  <input type="text" name="amount" class="form-control" value="{{ old('amount') }}">
</div>

<div class="form-group">
  <label>Detail</label>
  <textarea name="detail" class="form-control">{{ old('detail') }}</textarea>
</div>

<div class="form-group">
  <label>Note</label>
  <textarea name="note" class="form-control">{{ old('note') }}</textarea>
</div>

<button type="submit" class="btn btn-primary">Hantar Claim</button>

</form>
@endsection
