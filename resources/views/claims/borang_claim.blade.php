@extends('layouts/app')

@section('kandungan_page')
<form method="POST" action="<?php echo url()->current(); ?>">

  <?php echo csrf_field(); ?>

<div class="form-group">
  <label>Tajuk Claim</label>
  <input type="text" name="title" class="form-control">
</div>

<div class="form-group">
  <label>Tarikh Mula</label>
  <input type="date" name="tarikh_mula" class="form-control">
</div>

<div class="form-group">
  <label>Tarikh Tamat</label>
  <input type="date" name="tarikh_mula" class="form-control">
</div>

<div class="form-group">
  <label>Claim Amount</label>
  <input type="text" name="claim_amount" class="form-control">
</div>

<div class="form-group">
  <label>Nota</label>
  <textarea name="notes" class="form-control"></textarea>
</div>

<button type="submit" class="btn btn-primary">Hantar Claim</button>

</form>
@endsection
