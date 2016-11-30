@extends('layouts/app')

@section('kandungan_page')

@include('errors.alerts')

<p>
<a href="{{ url('user/claims') }}" class="btn btn-primary">Senarai Claims</a>
</p>

@if ( count( $claim ) )
<p>Berikut adalah maklumat claim yang telah {{ $user->name }} kirimkan.</p>

<table class="table table-bordered table-hover">

<thead>
  <tr class="active">
    <th>Item</th>
    <th>Value</th>
  </tr>
</thead>

<tbody>
  <tr>
    <td>ID Claim</td>
    <td>{{ $claim->id }}</td>
  </tr>
  <tr>
    <td>Title</td>
    <td>{{ $claim->title }}</td>
  </tr>
  <tr>
    <td>Start Date</td>
    <td>{{ $claim->start_date }}</td>
  </tr>
  <tr>
    <td>End Date</td>
    <td>{{ $claim->end_date }}</td>
  </tr>
  <tr>
    <td>Claim Amount</td>
    <td>RM{{ $claim->amount }}</td>
  </tr>
  <tr>
    <td>Claim Detail</td>
    <td>{{ $claim->detail }}</td>
  </tr>
  <tr>
    <td>Note</td>
    <td>{{ $claim->note }}</td>
  </tr>
  <tr>
    <td>Claim Status</td>
    <td>
      @if ( $claim->status == 'pending' )
      <span class="btn btn-sm btn-warning">{{ ucwords( $claim->status ) }}</span>
      @else
      <span class="btn btn-sm btn-success">{{ ucwords( $claim->status ) }}</span>
      @endif
    </td>
  </tr>
</tbody>

</table>

@else

<div class="alert alert-info">
  Tiada rekod claim dijumpai.
</div>

@endif

@endsection
