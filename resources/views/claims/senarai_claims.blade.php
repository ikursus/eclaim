@extends('layouts/app')

@section('header')
<link href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('kandungan_page')

@include('errors.alerts')

<p>
<a href="{{ url('user/claims/add') }}" class="btn btn-primary">New Claim</a>
</p>

<hr>

<div class="row">
  <div class="col-md-4">

    <div class="panel panel-default">
      <div class="panel-heading">Pending Claims</div>
      <div class="panel-body">
        {{ $claims_pending }}
      </div>
    </div>

  </div>
  <div class="col-md-4">

    <div class="panel panel-default">
      <div class="panel-heading">Approved Claims</div>
      <div class="panel-body">
        {{ $claims_approved }}
      </div>
    </div>

  </div>
  <div class="col-md-4">
  </div>
</div>

<hr>

<div class="table-responsive">
<table class="table table-bordered table-hover" id="claims-table">

<thead>
  <tr class="active">
    <th>ID</th>
    <th>Pemohon</th>
    <th>Title</th>
    <th>Start Date</th>
    <th>End Date</th>
    <th>Amount</th>
    <th>Detail</th>
    <th>Status</th>
    <th>Actions</th>
  </tr>
</thead>

</table>
</div><!--tutup table responsive -->

@endsection

@section('footer')
<script>
$(function() {
    $('#claims-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('datatablesClaims') !!}',
        columns: [
            { data: 'id', name: 'claims.id' },
            { data: 'name', name: 'users.name' },
            { data: 'title', name: 'claims.title' },
            { data: 'start_date', name: 'claims.start_date' },
            { data: 'end_date', name: 'claims.end_date' },
            { data: 'amount', name: 'claims.amount' },
            { data: 'detail', name: 'claims.detail' },
            { data: 'status', name: 'claims.status' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
});
</script>

@endsection
