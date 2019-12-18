<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')
    ->namespace('ManageUser')->prefix('manage-users')->as('manageUser.')->group(function() {
        Route::namespace('User')->group(function() {
                Route::prefix('user')->as('user.')->group(function() {
                        Route::get('/trash', 'UserController@trash')->name('trash');
                        Route::post('/restore/{id}', 'UserController@restore')->name('restore');
                        Route::delete('/{user}/force-destroy', 'UserController@forceDestroy')->name('forceDestroy');
                    });
                Route::resource('user', 'UserController');
            });


        Route::namespace('Organization')->group(function() {
                Route::prefix('organization')->as('organization.')->group(function() {
                        Route::get('/trash', 'OrganizationController@trash')->name('trash');
                        Route::post('/restore/{id}', 'OrganizationController@restore')->name('restore');
                        Route::delete('/{organization}/force-destroy', 'OrganizationController@forceDestroy')->name('forceDestroy');
                    });
                Route::resource('organization', 'OrganizationController');
            });

        Route::namespace('Role')->group(function() {
                Route::prefix('role')->as('role.')->group(function() {
                        Route::get('/trash', 'RoleController@trash')->name('trash');
                        Route::post('/restore/{id}', 'RoleController@restore')->name('restore');
                        Route::delete('/{role}/force-destroy', 'RoleController@forceDestroy')->name('forceDestroy');
                    });
                Route::resource('role', 'RoleController');
            });
    });

