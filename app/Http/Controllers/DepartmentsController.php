<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Department;

use App\User;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Dapatkan senarai departments
        $departments = Department::paginate(5);

        return view('departments/senarai_department', compact('departments') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('departments.borang_tambah_department', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation data daripada borang
        $this->validate( $request, [
          'name' => 'required|min:2'
        ]);

        // Dapatkan semua input dari borang
        $data = $request->all();

        // Simpan rekod ke dalam database
        Department::create( $data );

        // Redirect ke halaman senarai department
        return redirect('admin/departments')->with('success', 'Department baru ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Dapatkan deparment yang diperlukan
        $department = Department::find($id);

        return view('departments.borang_edit_department', compact('department') );
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
      // Validation data daripada borang
      $this->validate( $request, [
        'name' => 'required|min:2'
      ]);

      // Dapatkan semua input dari borang
      $data = $request->all();

      // Simpan rekod ke dalam database
      Department::find($id)->update( $data );

      // Redirect ke halaman senarai department
      return redirect('admin/departments')->with('success', 'Department berjaya dikemaskini.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      // Cari department
      Department::find( $id )->delete();

      // Redirect ke halaman senarai department
      return redirect('admin/departments')->with('success', 'Department berjaya dihapuskan!');
    }
}
