@extends('layouts/app')

@section('header')
<link href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('kandungan_page')

@include('errors/alerts')

<p>
<a href="{{ url('admin/users/add') }}" class="btn btn-primary">Tambah User</a>
</p>

<table class="table table-bordered" id="users-table">

  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Username</th>
      <th>Phone</th>
      <th>Designation</th>
      <th>Role</th>
      <th>Department</th>
    </tr>
  </thead>

</table>

@endsection

@section('footer')
<script>
$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('datatablesUsers') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'username', name: 'username' },
            { data: 'phone', name: 'phone' },
            { data: 'designation', name: 'designation' },
            { data: 'role', name: 'role' },
            { data: 'department_id', name: 'department_id' }
        ]
    });
});
</script>

@endsection
