
Route::get('/role', RebirthTobi\QubeRbac\Http\RoleController@index)->name('role');
Route::get('/role/{id}/view', RebirthTobi\QubeRbac\Http\RoleController@view)->name('role.view');
Route::get('/role/add', RebirthTobi\QubeRbac\Http\RoleController@create)->name('role.create');
Route::get('/role/{id}/edit', RebirthTobi\QubeRbac\Http\RoleController@edit)->name('role.edit');
Route::post('/role/store', RebirthTobi\QubeRbac\Http\RoleController@store)->name('role.store');
Route::patch('/role/{id}/update', RebirthTobi\QubeRbac\Http\RoleController@update)->name('role.update');

Route::get('/permission', RebirthTobi\QubeRbac\Http\PermissionController@index)->name('permission');
Route::get('/permission/add', RebirthTobi\QubeRbac\Http\PermissionController@create)->name('permission.create');
Route::get('/permission/{id}/edit', RebirthTobi\QubeRbac\Http\PermissionController@edit)->name('permission.edit');
Route::post('/permission/store', RebirthTobi\QubeRbac\Http\PermissionController@store)->name('permission.store');
Route::patch('/permission/{id}/update', RebirthTobi\QubeRbac\Http\PermissionController@update)->name('permission.update');