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
      <th>Actions</th>
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
            { data: 'id', name: 'users.id' },
            { data: 'name', name: 'users.name' },
            { data: 'username', name: 'users.username' },
            { data: 'phone', name: 'users.phone' },
            { data: 'designation', name: 'users.designation' },
            { data: 'role', name: 'users.role' },
            { data: 'department_name', name: 'departments.name' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
});
</script>

@endsection
