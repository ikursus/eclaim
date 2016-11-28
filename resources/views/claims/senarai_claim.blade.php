@extends('layouts/app')

@section('kandungan_page')

<p>
<a href="{{ url('user/claims/add') }}" class="btn btn-primary">New Claim</a>
</p>

<table class="table table-bordered table-hover">

<thead>
  <tr class="active">
    <th>ID</th>
    <th>Title</th>
    <th>Tarikh Mula</th>
    <th>Tarikh Tamat</th>
    <th>Amount (RM)</th>
    <th>Nota</th>
    <th>Status</th>
  </tr>
</thead>

<tbody>
  <tr>
    <th>1</th>
    <th>Contoh Claim 1</th>
    <th>2016-11-28</th>
    <th>2016-11-30</th>
    <th>300.00</th>
    <th>Claim perjalanan</th>
    <th>Pending</th>
  </tr>
</tbody>

</table>
@endsection

@section('footer')

@endsection
