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
    <th>Tindakan</th>
  </tr>
</thead>

<tbody>
  <tr>
    <td>1</th>
    <td>Contoh Claim 1</td>
    <td>2016-11-28</td>
    <td>2016-11-30</td>
    <td>300.00</td>
    <td>Claim perjalanan</td>
    <td>Pending</td>
    <td><a href="{{ url('user/claims/1') }}" class="btn btn-xs btn-info">Lihat</a></td>
  </tr>
</tbody>

</table>
@endsection

@section('footer')

@endsection
