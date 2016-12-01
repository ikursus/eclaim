<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use Illuminate\Support\Facades\Mail;
use Datatables;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // Dapatkan SEMUA rekod dari table users
      // $users = DB::table('users')->get();

      // Join table users dan departments untuk rekod nama department
      // $users = DB::table('users')
      // ->join('departments', 'users.department_id', '=', 'departments.id')
      // ->select('users.*', 'departments.name as department_name')
      // ->orderBy('id', 'desc')
      // ->paginate(3);

      // Paparkan borang senarai users
      // return view('users/senarai_users', compact('users') );
      return view('users/senarai_users');
    }

    public function datatables()
    {
      // Query data yang ingin dipaparkan pada senarai users
      $users = DB::table('users')
      ->join('departments', 'users.department_id', '=', 'departments.id')
      ->select(
        'users.id',
        'users.name',
        'users.username',
        'users.phone',
        'users.designation',
        'departments.name as department_name',
        'users.role'
      );

      // Return response
      return Datatables::of( $users )
      ->addColumn('action', function($key)
      {
        return '

        <a href="' . route('detailUser', ['id' => $key->id]) . '" class="btn btn-xs btn-info">Detail</a>
        <a href="' . route('editUser', ['id' => $key->id]) . '" class="btn btn-xs btn-primary">Edit</a>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete-' . $key->id . '">
            Delete
        </button>

        <!-- Modal -->
        <form method="POST" action="'. route('deleteUser', ['id' => $key->id ]) .'">

        <div class="modal fade" id="delete-' . $key->id . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
              </div>
              <div class="modal-body">

                <p>Are you sure you want to delete this item? ID: ' . $key->id . '</p>
                ' . csrf_field() . '
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
        ';
      })
      ->editColumn('role',
      '@if( $role == "admin" )
      <span class="btn btn-xs btn-success">{{ ucwords($role) }}</span>
      @else
      <span class="btn btn-xs btn-info">{{ ucwords($role) }}</span>
      @endif
      '
      )
      ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      // Dapatkan senarai departments
      $departments = DB::table('departments')
      ->select('name', 'id')
      ->get();

      // Paparkan borang tambah user
      return view('users/borang_tambah_user', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation rules
        $this->validate( $request, [
          'name' => 'required|min:3',
          'email' => 'required|email|unique:users,email',
          'username' => 'required|min:3|unique:users,username',
          'password' => 'required|min:3',
          'designation' => 'required',
          'role' => 'required|in:admin,user',
          'department_id' => 'required|integer'
        ]);

        // Jika tiada masalah dengan validation,
        // Dapatkan semua input daripada borang KECUALI
        // hidden _token dan password
        $data = $request->except('_token', 'password');

        // Tambah data dari input password ke array $data
        // dan Encrypt password
        $data['password'] = bcrypt( $request->input('password') );

        // Simpan rekod data ke dalam database
        DB::table('users')->insert( $data );

        // Tetapkan data yang ingin digunakan pada email
        $data = [
          'email' => $request->input('email'),
          'name' => $request->input('name'),
          'password' => $request->input('password')
        ];

        // Hantar email ke user
        Mail::send('emails.new_user', $data, function( $message ) use ( $data )
        {
          $message->from('admin@gmail.com', 'Admin Besar');
          $message->replyTo('support@johndoe.com', 'Support');
          $message->to( $data['email'],  $data['name']);
          $message->subject('Hello ' . $data['name'] . ', Akaun telah dihasilkan');
        });

        // Redirect ke halaman senarai user apabila sukses simpan rekod
        return redirect('admin/users')->with('success', 'User berjaya ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Dapatkan rekod user
        $user = User::find($id);

        return view('users/detail_user', compact('user') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Panggil rekod user ID yang dipilih (hanya ID saja)
        $user = DB::table('users')->find($id);

        // atau boleh guna WHERE (ID atau lain - lain column)
        // $user = DB::table('users')->where('id', '=', $id)->first();

        // Dapatkan senarai departments
        $departments = DB::table('departments')
        ->select('name', 'id')
        ->get();

        // Paparkan borang edit user dan pass sekali variable user dan departments
        return view('users/borang_edit_user', compact('user', 'departments') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      // Validation rules
      $this->validate( $request, [
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users,email,' . $id,
        'username' => 'required|min:3|unique:users,username,' . $id,
        'password' => 'min:3',
        'designation' => 'required',
        'role' => 'required|in:admin,user',
        'department_id' => 'required|integer'
      ]);

      // Dapatkan data user
      // $user = DB::table('users')->find($id);
      $user = User::find($id);

      // Jika tiada masalah dengan validation,
      // Dapatkan semua input daripada borang KECUALI
      // hidden _token dan password
      // $data = $request->only('name', 'department_id', 'designation', 'role');
      $data = $request->except('password');
      //
      // // Semak adakah data input email sama dengan rekod
      // if ( $request->input('email') != $user->email )
      // {
      //   $data['email'] = $request->input('email');
      // }
      //
      // // Semak adakah data input username sama dengan rekod
      // if( $request->input('username') != $user->username )
      // {
      //   $data['username'] = $request->input('username');
      // }

      // Tambah data dari input password ke array $data
      // dan Encrypt password JIKA ruangan password diisi
      if ( ! empty( $request->input('password') ) )
      {
        $data['password'] = bcrypt( $request->input('password') );
      }

      // Simpan rekod data ke dalam database
      $user->update( $data );

      // Redirect ke halaman senarai user apabila sukses simpan rekod
      return redirect('admin/users')->with('success', 'User berjaya dikemaskini!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('users')->where('id', '=', $id)->delete();

        return redirect('admin/users')->with('success', 'User berjaya dihapuskan!');
    }
}
