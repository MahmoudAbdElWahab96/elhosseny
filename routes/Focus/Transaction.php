<?php
use Illuminate\Support\Facades\Route;

/**
 * transactions
 *
 */
    Route::group(['namespace' => 'transaction'], function () {
        Route::post('transactions/payer_search','TransactionsController@payer_search' )->name('transactions.payer_search');
        Route::resource('transactions', 'TransactionsController');
        Route::get('transactionslist/getScreens', 'TransactionsController@getScreens')->name('transactions.getScreens');

        //For Datatable
        Route::post('transactions/get', 'TransactionsTableController')->name('transactions.get');
    });


