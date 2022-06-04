<?php

use Illuminate\Support\Facades\Route;

/**
 * Global Routes
 */
// Switch between the included languages

Route::get('lang/{lang}', [\App\Http\Controllers\LanguageController::class,'swap'])->name('lang');
Route::get('dir/{lang}', [\App\Http\Controllers\LanguageController::class,'direction'])->name('direction');

Route::get('biller/invoices/myinvoice', 'LanguageController@invoice')->name('biller.invoices.myinvoice');

Route::group(['namespace' => '\App\Http\Controllers\Focus', 'as' => 'biller.', 'middleware' => 'biller'], function () {
    includeRouteFiles(__DIR__.'/Focus/');
});
includeRouteFiles(__DIR__.'/General/');
