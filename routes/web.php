<?php
// Route homepage
Route::get('/', function () {
    return 'Selamat Datang Ke Laravel!';
});

// Route Login
Auth::routes();

// Route group untuk user
Route::group( ['prefix' => 'user'], function() {

  // Route dashboard user
  Route::get('dashboard', 'HomeController@index');

  // Route senarai claims user
  Route::get('claims', function() {
    return view('claims/senarai_claim');
  });

  // Route papar borang claim
  Route::get('claims/add', function() {
    return view('claims/borang_claim');
  });

  // Route hantar borang claim
  Route::post('claims/add', function() {
    return redirect('user/claims');
  });

  // Route detail claim pilihan berdasarkan ID
  Route::get('claims/{id}', function($id) {

    $name = '<strong>Ali Baba</strong>';

    // $array = ['id' => $id, 'name' => $name ];
    // return view('claims/detail_claim', $array );

    return view('claims/detail_claim', compact('id', 'name') );
  });

}); // Tutup Route::group() user.
