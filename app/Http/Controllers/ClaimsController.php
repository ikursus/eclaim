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

      // Senarai jumlah claim berdasarkan status
      $claims_pending = Claim::whereStatus('pending')->sum('amount');
      $claims_approved = Claim::whereStatus('approved')->sum('amount');

      // Paparkan template senarai claims bersama variable $claims dan $user
      return view('claims/senarai_claims', compact('claims', 'user', 'claims_pending', 'claims_approved') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $user = Auth::user();
      // Papar borang hantar claim
      return view('claims/borang_claim', compact('user'));
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
      return redirect('user/claims/' . $claim->id )->with('success', 'Claim anda sedang diproses.');
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

      // Dapatkan maklumat Claim yang ingin dilihat dan semak role user
      // Jika admin, benarkan untuk lihat mana - mana claim
      // Jika bukan admin, hanya benarkan lihat claim sendiri saja.
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

      // Paparkan template detail claim dan compact variable user dan claim
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
        // Tetapkan data untuk di update ke table Claim
        $data['status'] = $request->input('status');

        // Update rekod
        Claim::find($id)->update( $data );

        // Redirect ke halaman sedia ada
        return redirect()->back()->with('success', 'Rekod claim telah dikemaskini');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete claim
        Claim::find($id)->delete();

        return redirect()->back()->with('success', 'Rekod claim telah dihapuskan.');
    }
}
