Route::get('/hw', 'hwController@index');
Route::get('/delete/{id}', 'hwController@delete');
Route::post('/add', 'hwController@add');
Route::post('/edit', 'hwController@edit');
Route::get('/keres', 'hwController@keres');