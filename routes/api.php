<?php

use Illuminate\Support\Facades\Route;

Route::resource('menus', 'MenuController')->except([
    'create', 'edit'
]);

Route::resource('menus.items', 'MenuItemController')->only([
    'index', 'store'
]);
Route::delete('/menus/{menu}/items', 'MenuItemController@destroy');

Route::resource('items', 'ItemController')->except([
    'index', 'create', 'edit'
]);

Route::post('/items/{item}/children', 'ItemChildrenController@store');
Route::get('/items/{item}/children', 'ItemChildrenController@show');
Route::delete('/items/{item}/children', 'ItemChildrenController@destroy');


// Route::get('/menus/{menu}/layers/{layer}', 'MenuLayerController@show');
// Route::delete('/menus/{menu}/layers/{layer}', 'MenuLayerController@destroy');

// Route::get('/menus/{menu}/depth', 'MenuDepthController@show');