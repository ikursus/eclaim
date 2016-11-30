<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;

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
      $users = DB::table('users')
      ->join('departments', 'users.department_id', '=', 'departments.id')
      ->select('users.*', 'departments.name as department_name')
      ->orderBy('id', 'desc')
      ->paginate(3);

      // Paparkan borang senarai users
      return view('users/senarai_users', compact('users') );
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
