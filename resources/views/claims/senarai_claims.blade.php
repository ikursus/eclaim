@extends('layouts/app')

@section('kandungan_page')

<p>
<a href="{{ url('user/claims/add') }}" class="btn btn-primary">New Claim</a>
</p>

@if ( count( $claims ) )

<table class="table table-bordered table-hover">

<thead>
  <tr class="active">
    <th>ID</th>
    <th>Title</th>
    <th>Start Date</th>
    <th>End Date</th>
    <th>Amount</th>
    <th>Detail</th>
    <th>Status</th>
    <th>Actions</th>
  </tr>
</thead>

<tbody>

  @foreach( $claims as $key )
  <tr>
    <td>{{ $key->id }}</th>
    <td>{{ $key->title }}</td>
    <td>{{ $key->start_date }}</td>
    <td>{{ $key->end_date }}</td>
    <td>RM{{ $key->amount }}</td>
    <td>{{ $key->detail }}</td>
    <td>
      @if ( $key->status == 'pending' )
      <span class="btn btn-xs btn-warning">{{ ucwords( $key->status ) }}</span>
      @else
      <span class="btn btn-xs btn-success">{{ ucwords( $key->status ) }}</span>
      @endif
    </td>
    <td>

      <a href="{{ route('showClaim', ['id' => $key->id ]) }}" class="btn btn-xs btn-info">Lihat</a>

      @if ( $user->role == 'admin' )

      <form method="POST" action="{{ route('deleteClaim', ['id' => $key->id ]) }}">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit" class="btn btn-xs btn-danger">Delete</button>
      </form>

      @endif

    </td>
  </tr>
  @endforeach

</tbody>

</table>
@endif

@endsection

@section('footer')

@endsection
