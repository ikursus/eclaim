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
  Route::get('claims', 'ClaimsController@index');

  // Route papar borang claim
  Route::get('claims/add', 'ClaimsController@create');

  // Route hantar borang claim
  Route::post('claims/add', 'ClaimsController@store');

  // Route detail claim pilihan berdasarkan ID
  Route::get('claims/{id}', 'ClaimsController@show');

}); // Tutup Route::group() user.
