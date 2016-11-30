@extends('layouts/app')

@section('kandungan_page')

@include('errors.alerts')

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
      @elseif ( $key->status == 'cancelled' )
      <span class="btn btn-xs btn-default">{{ ucwords( $key->status ) }}</span>
      @else
      <span class="btn btn-xs btn-success">{{ ucwords( $key->status ) }}</span>
      @endif
    </td>
    <td>

      <a href="{{ route('showClaim', ['id' => $key->id ]) }}" class="btn btn-xs btn-info">Lihat</a>

      @if ( $user->role == 'admin' )

      <!-- Button trigger modal -->
      <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete-{{ $key->id }}">
          Delete
      </button>

      <!-- Modal -->
      <form method="POST" action="{{ route('deleteClaim', ['id' => $key->id ]) }}">

      <div class="modal fade" id="delete-{{ $key->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
            </div>
            <div class="modal-body">

              <p>Are you sure you want to delete this item? ID: {{ $key->id }}</p>
              {{ csrf_field() }}
              <input type="hidden" name="_method" value="DELETE">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger">Confirm Delete</button>
            </div>
          </div>
        </div>
      </div>

      </form>
      <!-- Modal -->
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
