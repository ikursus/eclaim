<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Claim;

class ClaimsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // Dapatkan rekod user yang sedang login
      $user = Auth::user();

      // Dapatkan rekod senarai claim berdasarkan role user
      if ( $user->role == 'admin' )
      {
        $claims = Claim::paginate(10);
      }
      else
      {
        $claims = Claim::where('user_id', $user->id)->paginate(10);
      }


      return view('claims/senarai_claims', compact('claims', 'user') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      // Papar borang hantar claim
      return view('claims/borang_claim');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // Validation
      $this->validate( $request, [
        'title' => 'required|min:3',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
        'amount' => 'required|numeric',
        'detail' => 'required|min:3'
      ] );

      // Tetapkan variable yang menerima semua input dari borang
      $data = $request->all();

      // Tambah maklumat data array ke variable $data
      $data['user_id'] = Auth::user()->id;
      $data['status'] = 'pending';

      // Simpan rekod ke dalam table claims
      $claim = Claim::create( $data );

      // Redirect ke halaman status claim
      return redirect('user/claims')->with('success', 'Claim anda sedang diproses.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      // Dapatkan detail user yang sedang login
      $user = Auth::user();

      // Dapatkan maklumat Claim yang dipilih dan pastikan ia memang milik user
      // yang sedang login
      if ( $user->role == 'admin' )
      {
        $claim = Claim::find($id);
      }
      else
      {
        $claim = Claim::where('id', $id)
        ->where('user_id', $user->id)
        ->first();
      }


      return view('claims/detail_claim', compact('user', 'claim') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
