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


// Route group untuk user
Route::group( ['prefix' => 'admin'], function() {

  // Route dashboard user
  Route::get('dashboard', 'HomeController@index');

  // Route senarai user
  Route::get('users', 'UsersController@index');

  // Route papar borang tambah user
  Route::get('users/add', 'UsersController@create');

  // Route terima data dari borang tambah user
  Route::post('users/add', 'UsersController@store');

  // Route detail claim pilihan berdasarkan ID
  Route::get('users/{id}', 'UsersController@edit');

}); // Tutup Route::group() user.
