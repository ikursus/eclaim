<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Claim;
use DB;
use Datatables;

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

      // Senarai jumlah claim berdasarkan status
      $claims_pending = Claim::whereStatus('pending')->sum('amount');
      $claims_approved = Claim::whereStatus('approved')->sum('amount');

      // Paparkan template senarai claims bersama variable $claims dan $user
      return view('claims/senarai_claims', compact('user', 'claims_pending', 'claims_approved') );
    }

    public function datatables()
    {
      // Dapatkan rekod user yang sedang login
      $user = Auth::user();

      // Dapatkan rekod senarai claim berdasarkan role user
      if ( $user->role == 'admin' )
      {
        $claims = DB::table('claims')->join('users', 'claims.user_id', '=', 'users.id')
        ->select('claims.id', 'claims.title', 'claims.start_date', 'claims.end_date', 'claims.amount', 'claims.detail', 'claims.status', 'users.name');
      }
      else
      {
        $claims = DB::table('claims')->join('users', 'claims.user_id', '=', 'users.id')
        ->where('claims.user_id', '=', $user->id)
        ->select('claims.id', 'claims.title', 'claims.start_date', 'claims.end_date', 'claims.amount', 'claims.detail', 'claims.status', 'users.name');
      }

      // Return response
      return Datatables::of( $claims )
      ->addColumn('action', function($key)
      {
        return '

        <a href="' . route('showClaim', ['id' => $key->id]) . '" class="btn btn-xs btn-info">Detail</a>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete-' . $key->id . '">
            Delete
        </button>

        <!-- Modal -->
        <form method="POST" action="'. route('deleteClaim', ['id' => $key->id ]) .'">

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
      ->make(true);
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
