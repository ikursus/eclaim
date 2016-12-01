<?php
// Route homepage
Route::get('/', 'HomeController@index');

// Route Login
Auth::routes();

// Route group untuk user
Route::group( ['prefix' => 'user', 'middleware' => 'auth'], function() {

  // Route dashboard user
  Route::get('dashboard', 'HomeController@dashboard');

  // Route senarai claims user
  Route::get('claims', 'ClaimsController@index');

  // Route papar borang claim
  Route::get('claims/add', 'ClaimsController@create');

  // Route hantar borang claim
  Route::post('claims/add', 'ClaimsController@store')->name('storeClaim');

  // Route detail claim pilihan berdasarkan ID
  Route::get('claims/{id}', 'ClaimsController@show')->name('showClaim');

  // Route approve claim oleh admin
  Route::patch('claims/{id}', 'ClaimsController@update')->name('updateClaim');

  // Route delete claim pilihan berdasarkan ID
  Route::delete('claims/{id}', 'ClaimsController@destroy')->name('deleteClaim');

}); // Tutup Route::group() user.


// Route group untuk user
Route::group( ['prefix' => 'admin', 'middleware' => 'auth'], function() {

  // Route dashboard user
  Route::get('dashboard', 'HomeController@index');

  // Route senarai user
  Route::get('users', 'UsersController@index');

  // Ajax request untuk datatabase
  Route::get('users/datatables', 'UsersController@datatables')->name('datatablesUsers');

  // Route papar borang tambah user
  Route::get('users/add', 'UsersController@create');

  // Route terima data dari borang tambah user
  Route::post('users/add', 'UsersController@store');

  // Route edit detail user pilihan berdasarkan ID
  Route::get('users/{id}', 'UsersController@show')->name('detailUser');

  // Route edit detail user pilihan berdasarkan ID
  Route::get('users/{id}/edit', 'UsersController@edit')->name('editUser');

  // Route untuk kemaskini rekod user ID yang dipilih
  Route::patch('users/{id}', 'UsersController@update')->name('updateUser');

  Route::delete('users/{id}', 'UsersController@destroy')->name('deleteUser');


  // Route senarai department
  Route::get('departments', 'DepartmentsController@index');

  // Route papar borang tambah department
  Route::get('departments/add', 'DepartmentsController@create')->name('addDepartment');

  // Route terima data dari borang tambah department
  Route::post('departments/add', 'DepartmentsController@store')->name('storeDepartment');

  // Route detail department pilihan berdasarkan ID
  Route::get('departments/{id}', 'DepartmentsController@edit')->name('editDepartment');

  // Route untuk kemaskini rekod department ID yang dipilih
  Route::patch('departments/{id}', 'DepartmentsController@update')->name('updateDepartment');

  // Route untuk hapuskan department
  Route::delete('departments/{id}', 'DepartmentsController@destroy')->name('deleteDepartment');

}); // Tutup Route::group() user.
