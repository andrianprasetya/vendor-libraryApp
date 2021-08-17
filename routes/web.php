<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('web::dashboard.index');
    } else {
        return redirect('login');
    }
});

Route::group(['namespace' => 'Auth', 'prefix' => '/'], function () {

    // # LOGIN
    Route::get('/login', 'LoginController@showLoginForm')->name('login');
    Route::post('/login', 'LoginController@login');

    // # LOGOUT
    Route::post('/logout', 'LoginController@logout')->name('logout');
});

Route::group(['as' => 'web::', 'prefix' => 'web', 'namespace' => 'Web', 'middleware' => 'auth'], function () {

    Route::get('dashboard', ['as' => 'dashboard.index', 'uses' => 'DashboardController@index']);


    Route::group(['as' => 'member.', 'prefix' => 'member'], function () {
        Route::get('/', ['as' => 'index', 'middleware' => 'access:index,web/member', 'uses' => 'MemberController@index']);
        Route::get('datatables', ['as' => 'datatables','middleware' => 'access:index,web/member', 'uses' => 'MemberController@getDatatable']);
        Route::get('create', ['as' => 'create','middleware' => 'access:index,web/member', 'uses' => 'MemberController@create']);
        Route::get('show/{id}', ['as' => 'show','middleware' => 'access:index,web/member', 'uses' => 'MemberController@show']);
        Route::get('edit/{id}', ['as' => 'edit','middleware' => 'access:index,web/member', 'uses' => 'MemberController@edit']);
        Route::get('getProvince', ['as' => 'getProvince','middleware' => 'access:index,web/member', 'uses' => 'MemberController@getProvince']);
        Route::get('getDistrict', ['as' => 'getDistrict','middleware' => 'access:index,web/member', 'uses' => 'MemberController@getDistrict']);
        Route::get('getRegency', ['as' => 'getRegency','middleware' => 'access:index,web/member', 'uses' => 'MemberController@getRegency']);
        Route::post('store', ['as' => 'store' ,'middleware' => 'access:index,web/member', 'uses' => 'MemberController@store']);
        Route::post('update/{id}', ['as' => 'update' ,'middleware' => 'access:index,web/member', 'uses' => 'MemberController@update']);
    });

    Route::group(['as' => 'sirkulasi.', 'prefix' => 'sirkulasi'], function () {
        Route::group(['as' => 'peminjaman.', 'prefix' => 'peminjaman'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'LoanController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'LoanController@create']);
            Route::get('getDataUser', ['as' => 'getDataUser', 'uses' => 'LoanController@getDataUser']);
            Route::get('getDataBook', ['as' => 'getDataBook', 'uses' => 'LoanController@getDataBook']);
            Route::get('datatableSingle', ['as' => 'datatableSingle', 'uses' => 'LoanController@getDatatableSingle']);
            Route::get('datatables', ['as' => 'datatables', 'uses' => 'LoanController@getDatatable']);
            Route::post('store', ['as' => 'store' , 'uses' => 'LoanController@store']);
        });
        Route::group(['as' => 'pengembalian.', 'prefix' => 'pengembalian'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'ReturnController@index']);
            Route::get('datatables', ['as' => 'datatables', 'uses' => 'ReturnController@getDatatable']);
            Route::get('create', ['as' => 'create', 'uses' => 'ReturnController@create']);
        });
        Route::group(['as' => 'perpanjangan.', 'prefix' => 'perpanjangan'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'ExtraController@index']);
            Route::get('datatables', ['as' => 'datatables', 'uses' => 'ExtraController@getDatatable']);
            Route::get('create', ['as' => 'create', 'uses' => 'ExtraController@create']);
        });
    });
    Route::group(['as' => 'book.', 'prefix' => 'book'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'BookController@index']);
        Route::get('create', ['as' => 'create', 'uses' => 'BookController@create']);
        Route::get('datatables', ['as' => 'datatables', 'uses' => 'BookController@getDatatable']);
        Route::get('show/{id}', ['as' => 'show', 'uses' => 'BookController@show']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'BookController@edit']);
        Route::post('store', ['as' => 'store', 'uses' => 'BookController@store']);
        Route::post('update/{id}', ['as' => 'update' , 'uses' => 'BookControllerr@update']);
        Route::post('pattern_book' , ['as' => 'pattern_book' , 'uses' => 'BookController@pattern_book']);
        Route::get('getCode', ['as' => 'getCode', 'uses' => 'BookController@getCode']);
    });

});
