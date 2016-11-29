@extends('layouts/app')

@section('kandungan_page')

@include('errors/alerts')

<p>
<a href="{{ url('admin/users/add') }}" class="btn btn-primary">Tambah User</a>
</p>

@if ( count( $users ) )

<table class="table table-bordered">
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Username</th>
      <th>Phone</th>
      <th>Designation</th>
      <th>Role</th>
      <th>Department</th>
      <th>Action</th>
    </tr>
  </thead>

  <tbody>

    @foreach( $users as $key )
    <tr>
      <td>{{ $key->id }}</td>
      <td>{{ $key->name }}</td>
      <td>{{ $key->username }}</td>
      <td>{{ $key->phone }}</td>
      <td>{{ $key->designation }}</td>
      <td>{{ $key->role }}</td>
      <td>{{ $key->department_name }}</td>
      <td>
        <a href="{{ url('admin/users/' . $key->id ) }}" class="btn btn-xs btn-info">Edit</a>

        <form method="POST" action="{{ route('deleteUser', ['id' => $key->id ]) }}">
          {{ csrf_field() }}
          <input type="hidden" name="_method" value="DELETE">
          <button type="submit" class="btn btn-xs btn-danger">Delete</button>
        </form>

      </td>
    </tr>
    @endforeach

  </tbody>
</table>

{{ $users->links() }}

<p>{{ $users->count() }} orang dari Total users keseluruhan {{ $users->total() }}</p>

@endif

@endsection
