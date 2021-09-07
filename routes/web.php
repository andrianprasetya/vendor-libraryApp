<?php

use Illuminate\Support\Facades\App;
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
    Route::get('about', ['as' => 'about', 'uses' => 'DashboardController@about']);


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
        Route::post('changePassword/{id}', ['as' => 'changePassword' , 'uses' => 'MemberController@changePassword']);
        Route::get('print-card/{id}', ['as' => 'print-card' , 'uses' => 'MemberController@printCard']);
        Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'MemberController@Destroy']);

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
            Route::get('show/{id}', ['as' => 'show' , 'uses' => 'LoanController@show']);
            Route::post('return/{id}', ['as' => 'return' , 'uses' => 'LoanController@return']);
            Route::get('extend/{id}', ['as' => 'extend' , 'uses' => 'LoanController@extend']);
            Route::post('perpanjangan/{id}', ['as' => 'perpanjangan' , 'uses' => 'LoanController@perpanjangan']);
            Route::post('dendaNominal/{id}', ['as' => 'dendaNominal' , 'uses' => 'LoanController@dendaNominal']);
            Route::post('dendaBook/{id}', ['as' => 'dendaBook' , 'uses' => 'LoanController@dendaBook']);
            Route::get('getBook', ['as' => 'getBook', 'uses' => 'LoanController@getBook']);
        });
        Route::group(['as' => 'denda.', 'prefix' => 'denda'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'FinesController@index']);
            Route::get('datatables', ['as' => 'datatables', 'uses' => 'FinesController@getDatatable']);
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
        Route::get('datatableCodes', ['as' => 'datatableCodes', 'uses' => 'BookController@getDatatableCode']);
        Route::get('show/{id}', ['as' => 'show', 'uses' => 'BookController@show']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'BookController@edit']);
        Route::get('edit-code/{id}', ['as' => 'edit-code', 'uses' => 'BookController@editCode']);
        Route::post('store', ['as' => 'store', 'uses' => 'BookController@store']);
        Route::post('update-code/{id}', ['as' => 'update-code' , 'uses' => 'BookController@updateCode']);
        Route::post('update/{id}', ['as' => 'update' , 'uses' => 'BookController@update']);
        Route::post('pattern_book' , ['as' => 'pattern_book' , 'uses' => 'BookController@pattern_book']);
        Route::get('getCode', ['as' => 'getCode', 'uses' => 'BookController@getCode']);
        Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'BookController@Destroy']);
    });

    Route::group(['as' => 'opac.', 'prefix' => 'opac'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'OpacController@index']);
        Route::get('getBook', ['as' => 'getBook', 'uses' => 'OpacController@getBook']);
        Route::get('detail/{id}', ['as' => 'detail', 'uses' => 'OpacController@detail']);
    });

    Route::group(['as' => 'profile.', 'prefix' => 'profile'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'ProfileController@index']);
        Route::get('getProvince', ['as' => 'getProvince', 'uses' => 'ProfileController@getProvince']);
        Route::get('getDistrict', ['as' => 'getDistrict', 'uses' => 'ProfileController@getDistrict']);
        Route::get('getRegency', ['as' => 'getRegency','uses' => 'ProfileController@getRegency']);
    });


    Route::group(['as' => 'report.', 'prefix' => 'report'], function () {
        Route::get('member', ['as' => 'member', 'uses' => 'ReportController@reportMember']);
        Route::get('datatableReportMembers', ['as' => 'datatableReportMembers', 'uses' => 'ReportController@getDatatableMember']);
        Route::get('detail-member/{id}', ['as' => 'detail-member', 'uses' => 'ReportController@detailMember']);
        Route::get('datatableDetailMemberReports', ['as' => 'datatableDetailMemberReports', 'uses' => 'ReportController@getDatatableDetailMember']);
        Route::get('collection', ['as' => 'collection', 'uses' => 'ReportController@reportCollection']);
        Route::get('datatableReportCollectiones', ['as' => 'datatableReportCollectiones', 'uses' => 'ReportController@getDatatableCollection']);
        Route::get('language', ['as' => 'language', 'uses' => 'ReportController@reportLanguage']);
        Route::get('datatableReportLanguages', ['as' => 'datatableReportLanguages', 'uses' => 'ReportController@getDatatableLanguage']);
        Route::get('gmd', ['as' => 'gmd', 'uses' => 'ReportController@reportGMD']);
        Route::get('datatableReportGMD', ['as' => 'datatableReportGMD', 'uses' => 'ReportController@getDatatableGMD']);

    });
});
