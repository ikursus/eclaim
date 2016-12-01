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

  // Route AJAX claims user
  Route::get('claims/datatables', 'ClaimsController@datatables')->name('datatablesClaims');

  // Route papar borang claim
  Route::get('claims/add', 'ClaimsController@create')->name('createClaim');

  // Route hantar borang claim
  Route::post('claims/add', 'ClaimsController@store')->name('storeClaim');

  // Route detail claim pilihan berdasarkan ID
  Route::get('claims/{id}', 'ClaimsController@show')->name('showClaim');

  // Route approve claim oleh admin
  Route::patch('claims/{id}', 'ClaimsController@update')->name('updateClaim');

  // Route delete claim pilihan berdasarkan ID
  Route::delete('claims/{id}', 'ClaimsController@destroy')->name('deleteClaim');

}); // Tutup Route::group() user.


// Route prefix admin: http://localhost/admin
Route::group( ['prefix' => 'admin', 'middleware' => 'auth'], function() {

  // Route dashboard user
  Route::get('dashboard', 'HomeController@index');

  // Route prefix users: http://localhost/admin/users
  Route::group(['prefix' => 'users'], function() {

    // Route senarai users
    Route::get('/', 'UsersController@index');

    // Ajax request untuk datatabase
    Route::get('datatables', 'UsersController@datatables')->name('datatablesUsers');

    // Route papar borang tambah user
    Route::get('add', 'UsersController@create');

    // Route terima data dari borang tambah user
    Route::post('add', 'UsersController@store');

    // Route edit detail user pilihan berdasarkan ID
    Route::get('{id}', 'UsersController@show')->name('detailUser');

    // Route edit detail user pilihan berdasarkan ID
    Route::get('{id}/edit', 'UsersController@edit')->name('editUser');

    // Route untuk kemaskini rekod user ID yang dipilih
    Route::patch('{id}', 'UsersController@update')->name('updateUser');

    Route::delete('{id}', 'UsersController@destroy')->name('deleteUser');
  });


  // Route prefix departments http://localhost/admin/departments
  Route::group(['prefix' => 'departments'], function() {

    // Route senarai department
    Route::get('/', 'DepartmentsController@index');

    // Route papar borang tambah department
    Route::get('add', 'DepartmentsController@create')->name('addDepartment');

    // Route terima data dari borang tambah department
    Route::post('add', 'DepartmentsController@store')->name('storeDepartment');

    // Route detail department pilihan berdasarkan ID
    Route::get('{id}', 'DepartmentsController@edit')->name('editDepartment');

    // Route untuk kemaskini rekod department ID yang dipilih
    Route::patch('{id}', 'DepartmentsController@update')->name('updateDepartment');

    // Route untuk hapuskan department
    Route::delete('{id}', 'DepartmentsController@destroy')->name('deleteDepartment');

  });

}); // Tutup Route::group() user.
