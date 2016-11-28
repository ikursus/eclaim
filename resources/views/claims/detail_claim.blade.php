@extends('layouts/app')

@section('kandungan_page')

<p>
<a href="{{ url('user/claims') }}" class="btn btn-primary">Senarai Claims</a>
</p>

<table class="table">

<thead>
  <tr>
    <th>Item</th>
    <th>Value</th>
  </tr>
</thead>

<tbody>
  <tr>
    <td>ID</td>
    <td>1</td>
  </tr>
  <tr>
    <td>Title</td>
    <td>Contoh Claim 1</td>
  </tr>
  <tr>
    <td>Tarikh Mula</td>
    <td>2016-11-28</td>
  </tr>
  <tr>
    <td>Tarikh Tamat</td>
    <td>2016-12-01</td>
  </tr>
  <tr>
    <td>Claim Amount (RM)</td>
    <td>300.00</td>
  </tr>
  <tr>
    <td>Nota</td>
    <td>Contoh Nota</td>
  </tr>
  <tr>
    <td>Status</td>
    <td>Pending</td>
  </tr>
</tbody>

</table>

@endsection
