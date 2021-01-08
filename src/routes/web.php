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


Route::get('/', 'HomeController')->name('home');
Route::get('/blocks', 'BlockController@getBlocks')->name('blocks');
Route::get('/block/{height?}', 'BlockController@getBlock')->where('height', '[0-9]+')->name('block');
Route::get('/txs/{tx?}', 'TransactionController@getTransactions')->where('tx', '[A-Za-z0-9]{64}')->name('transactions');
Route::get('/mempool', 'TransactionController@getMempoolTransactions')->name('transactions_mempool');
Route::get('/address/{address}', 'AddressController@getAddress')->where('tx', '[A-Za-z0-9]{34}')->name('address');

Route::get('/claims', 'ClaimController@getClaims')->name('claims');
Route::get('/claim/{claim?}', 'ClaimController@getClaim')->where('claim', '[A-Za-z0-9\-]+')->name('claim');

Route::get('/search', 'SearchController')->where('what', '[A-Za-z0-9]+');
