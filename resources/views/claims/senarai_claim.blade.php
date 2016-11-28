@extends('layouts/app')

@section('kandungan_page')

<p>
<a href="{{ url('user/claims/add') }}" class="btn btn-primary">New Claim</a>
</p>

@if ( count( $senarai_claims ) )

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

  @foreach( $senarai_claims as $key => $value )
  <tr>
    <td>{{ $key }}</th>
    <td>{{ $value }}</td>
    <td>2016-11-28</td>
    <td>2016-11-30</td>
    <td>300.00</td>
    <td>Claim perjalanan</td>
    <td>Pending</td>
    <td><a href="{{ url('user/claims/1') }}" class="btn btn-xs btn-info">Lihat</a></td>
  </tr>
  @endforeach

</tbody>

</table>
@endif

@endsection

@section('footer')

@endsection
