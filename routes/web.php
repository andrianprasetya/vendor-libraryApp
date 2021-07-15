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
        Route::get('index', ['as' => 'index', 'uses' => 'MemberController@index']);
        Route::get('datatables', ['as' => 'datatables', 'uses' => 'MemberController@getDatatable']);
        Route::get('create', ['as' => 'create', 'uses' => 'MemberController@create']);
        Route::get('getProvince', ['as' => 'getProvince', 'uses' => 'MemberController@getProvince']);
        Route::get('getDistrict', ['as' => 'getDistrict', 'uses' => 'MemberController@getDistrict']);
        Route::get('getRegency', ['as' => 'getRegency', 'uses' => 'MemberController@getRegency']);
    });
    Route::group(['as' => 'sirkulasi.', 'prefix' => 'sirkulasi'], function () {
        Route::group(['as' => 'peminjaman.', 'prefix' => 'peminjaman'], function () {
            Route::get('index', ['as' => 'index', 'uses' => 'BorrowController@index']);
            Route::get('datatables', ['as' => 'datatables', 'uses' => 'BorrowController@getDatatable']);
            Route::get('create', ['as' => 'create', 'uses' => 'BorrowController@create']);
        });
        Route::group(['as' => 'pengembalian.', 'prefix' => 'pengembalian'], function () {
            Route::get('index', ['as' => 'index', 'uses' => 'ReturnController@index']);
            Route::get('datatables', ['as' => 'datatables', 'uses' => 'ReturnController@getDatatable']);
            Route::get('create', ['as' => 'create', 'uses' => 'ReturnController@create']);
        });
        Route::group(['as' => 'perpanjangan.', 'prefix' => 'perpanjangan'], function () {
            Route::get('index', ['as' => 'index', 'uses' => 'ExtraController@index']);
            Route::get('datatables', ['as' => 'datatables', 'uses' => 'ExtraController@getDatatable']);
            Route::get('create', ['as' => 'create', 'uses' => 'ExtraController@create']);
        });
    });
    Route::group(['as' => 'book.', 'prefix' => 'book'], function () {
        Route::get('index', ['as' => 'index', 'uses' => 'BookController@index']);
        Route::get('create', ['as' => 'create', 'uses' => 'BookController@create']);
        Route::post('store', ['as' => 'store', 'uses' => 'BookController@store']);
    });

});
