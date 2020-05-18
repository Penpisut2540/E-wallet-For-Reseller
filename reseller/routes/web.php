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

//localhost/reseller/public/login
Route::get('/', function () {
    return view('auth/login');
});

//login logout
Auth::routes();

//Route for reseller (normal users)
Route::group(['middleware' => ['auth']], function () {
    //Route Reseller
    Route::get('/home', 'HomeController@index')->name('home'); //--not use
    Route::get('/profileuser', 'reseller\resellerController@showprofilereseller')->name('profileuser');
    Route::get('/editprofileuser/{id}', 'reseller\resellerController@editprofilereseller')->name('editprofileuser'); //--not use
    Route::put('/updateeditprofilereseller/{id}', 'reseller\resellerController@updateeditprofilereseller')->name('updateeditprofilereseller');
    Route::get('/credituser', 'reseller\resellerController@showcredituser')->name('credituser');
    Route::get('/showproduct', 'reseller\resellerController@showproduct')->name('showproduct');
    Route::get('/buyorder/{id}', 'reseller\resellerController@buyorder')->name('buyorder'); //--not use
    Route::post('/storebuyorder', 'reseller\resellerController@storebuyorder')->name('storebuyorder');
    Route::get('/showhistoryuser', 'reseller\resellerController@showhistoryuser')->name('showhistoryuser');
    Route::get('/orderdetails/{id}', 'reseller\resellerController@orderdetails')->name('orderdetails'); //--not use
    Route::get('/showtopuppaycredituser', 'reseller\resellerController@showtopuppaycredituser')->name('showtopuppaycredituser');
    Route::get('/appcredit', 'reseller\resellerController@showbalance')->name('showbalance');
    Route::get('/searchhistoryuser', 'reseller\resellerController@searchhistoryuser')->name('searchhistoryuser');
    Route::get('/showcontact', 'reseller\resellerController@showcontact')->name('showcontact');
    Route::post('/sendemail', 'reseller\resellerController@sendemail')->name('sendemail');
});

//Route for admin
Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => ['admin']], function () {
        Route::get('/dashboard', 'admin\AdminController@index')->name('dashboard');
        Route::get('/manageuserbyadmin', 'admin\AdminController@show')->name('manageuserbyadmin');
        Route::get('/manageadminbyadmin', 'admin\AdminController@showmanageadminbyadmin')->name('manageadminbyadmin');
        Route::get('/adduserbyadmin', 'admin\AdminController@create')->name('adduserbyadmin'); //--not use
        Route::get('/addadminbyadmin', 'admin\AdminController@addadminbyadmin')->name('addadminbyadmin'); //--not use
        Route::post('/storeadduserbyadmin', 'admin\AdminController@store')->name('storeuserbyadmin');
        Route::post('/storeadminbyadmin', 'admin\AdminController@storeadminbyadmin')->name('storeadminbyadmin');
        Route::get('/edituserbyadmin/{id}', 'admin\AdminController@edit')->name('edituserbyadmin'); //--not use
        Route::put('/updateedituserbyadmin/{id}', 'admin\AdminController@update')->name('updateedituserbyadmin');
        Route::delete('/deleteuserbyadmin/{id}', 'admin\AdminController@delete')->name('deleteuserbyadmin');
        Route::delete('/deleteadminbyadmin/{id}', 'admin\AdminController@deleteadminbyadmin')->name('deleteadminbyadmin');
        Route::get('/profileadmin', 'admin\AdminController@showprofileadmin')->name('profileadmin');
        Route::get('/editprofileadmin/{id}', 'admin\AdminController@editprofileadmin')->name('editprofileadmin'); //--not use
        Route::put('/updateeditprofilebyadmin/{id}', 'admin\AdminController@updateeditprofileadmin')->name('updateeditprofileadmin');
        Route::get('/managecreditbyadmin', 'admin\CreditController@show')->name('managecreditbyadmin'); //--not use
        Route::get('/insertcreditbyadmin', 'admin\CreditController@insertCredit')->name('insertcreditbyadmin'); //--not use
        Route::delete('/delectcreditbyadmin/{id}', 'admin\CreditController@delectCredit')->name('delectcreditbyadmin'); //--not use
        Route::post('/storecreditbyadmin', 'admin\CreditController@storeCredit')->name('storecreditbyadmin'); //--not use
        Route::get('/addmoneybyadmin/{id}', 'admin\CreditController@addmoneybyadmin')->name('addmoneybyadmin');
        Route::post('/updatemoneybyadmin/{id}', 'admin\CreditController@update')->name('updatemoneybyadmin');
        Route::get('/showhistoryadmin', 'admin\AdminController@showhistoryadmin')->name('showhistoryadmin');
        Route::get('/searchuseradmin', 'admin\AdminController@searchuseradmin')->name('searchuseradmin');
        Route::get('/searchadminuseradmin', 'admin\AdminController@searchadminuseradmin')->name('searchadminuseradmin');
        Route::get('/searchcreditadmin', 'admin\CreditController@searchcreditadmin')->name('searchcreditadmin');
        Route::get('/searchhistoryadmin', 'admin\AdminController@searchhistoryadmin')->name('searchhistoryadmin');
        Route::get('/showtopuppaycreditadd', 'admin\CreditController@showtopuppaycreditadd')->name('showtopuppaycreditadd'); //-- not use
        Route::get('/showtopuppaycredituse', 'admin\CreditController@showtopuppaycredituse')->name('showtopuppaycredituse'); //-- not use
        Route::get('/showtopuppaycreditchange', 'admin\CreditController@showtopuppaycreditchange')->name('showtopuppaycreditchange'); //-- not use
        Route::get('/showtopuppaycredit', 'admin\CreditController@showtopuppaycredit')->name('showtopuppaycredit');
        Route::get('/searchtopuppaycredit', 'admin\CreditController@searchtopuppaycredit')->name('searchtopuppaycredit');
        Route::get('/showproductadmin', 'admin\AdminController@showproductadmin')->name('showproductadmin');
        Route::get('/showdetailsuser/{id}', 'admin\AdminController@showdetailsuser')->name('showdetailsuser');
        Route::get('/showdetailsadmin/{id}', 'admin\AdminController@showdetailsadmin')->name('showdetailsadmin');
        Route::post('/savechangmoneybyadmin/{id}', 'admin\CreditController@savechangmoneybyadmin')->name('savechangmoneybyadmin');
        Route::get('/searchhistoryadminbydate', 'admin\AdminController@searchhistoryadminbydate')->name('searchhistoryadminbydate');
        Route::get('/exporttoexcel', 'admin\AdminController@exporttoexcel')->name('exporttoexcel');
        Route::get('/exportresellertoexcel', 'admin\AdminController@exportresellertoexcel')->name('exportresellertoexcel');
        Route::get('/exportrehiscredittoexcel', 'admin\AdminController@exportrehiscredittoexcel')->name('exportrehiscredittoexcel');
    });
});
