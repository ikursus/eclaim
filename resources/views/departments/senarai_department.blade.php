@extends('layouts/app')

@section('kandungan_page')

@include('errors/alerts')

<p>
<a href="{{ route('addDepartment') }}" class="btn btn-primary">Tambah Department</a>
</p>

@if ( count( $departments ) )

<table class="table table-bordered">
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Action</th>
    </tr>
  </thead>

  <tbody>

    @foreach( $departments as $key )
    <tr>
      <td>{{ $key->id }}</td>
      <td>{{ $key->name }}</td>
      <td>
        <a href="{{ route('editDepartment', [ 'id' => $key->id ]) }}" class="btn btn-xs btn-info">Edit</a>

        <form method="POST" action="{{ route('deleteDepartment', ['id' => $key->id ]) }}">
          {{ csrf_field() }}
          <input type="hidden" name="_method" value="DELETE">
          <button type="submit" class="btn btn-xs btn-danger">Delete</button>
        </form>

      </td>
    </tr>
    @endforeach

  </tbody>
</table>

{{ $departments->links() }}

@endif

@endsection
