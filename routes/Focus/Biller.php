<?php
use Illuminate\Support\Facades\Route;

/**
 * FocusRoutes
 *
 */

Route::group(['namespace' => 'account'], function () {
    Route::get('accounts/balancesheet/{type}', 'AccountsController@balance_sheet')->name('accounts.balance_sheet');
    Route::get('accounts/appendScreens', 'AccountsController@appendScreens')->name('accounts.appendScreens');
    Route::resource('accounts', 'AccountsController');
    Route::get('removeSession', 'AccountsController@removeSession')->name('accounts.removeSession');

    //For Datatable
    Route::post('accounts/get', 'AccountsTableController')->name('accounts.get');
    Route::get('accounts/cost_centers/{id}', 'AccountsController@getCostCentersAccount')->name('accounts.cost_centers');
});

Route::group(['namespace' => 'additional'], function () {
    Route::resource('additionals', 'AdditionalsController');
    //For Datatable
    Route::post('additionals/get', 'AdditionalsTableController')->name('additionals.get');
});

Route::group(['namespace' => 'discount'], function () {
    Route::resource('discounts', 'DiscountsController');
    //For Datatable
    Route::post('discounts/get', 'DiscountsTableController')->name('discounts.get');
});

Route::group(['namespace' => 'openingBalance'], function () {
    Route::resource('opening_balance', 'OpeningBalanceController');
    //For Datatable
    Route::post('opening_balance/get', 'OpeningBalanceTableController')->name('opening_balance.get');
});

Route::group(['namespace' => 'market'], function () {
    Route::resource('markets', 'MarketController');

    //For Datatable
    Route::post('market/get', 'MarketTableController')->name('markets.get');
    Route::get('markets/{id}/edits', 'MarketController@edit2')->name('markets.edit2');
});

Route::group(['namespace' => 'bank'], function () {
    Route::resource('banks', 'BanksController');
    //For Datatable
    Route::post('banks/get', 'BanksTableController')->name('banks.get');
});

Route::group(['namespace' => 'currency'], function () {
    Route::resource('currencies', 'CurrenciesController');
    //For Datatable
    Route::post('currencies/get', 'CurrenciesTableController')->name('currencies.get');
});
Route::group(['namespace' => 'customergroup'], function () {
    Route::resource('customergroups', 'CustomergroupsController');
    //For Datatable
    Route::post('customergroups/get', 'CustomergroupsTableController')->name('customergroups.get');
});

Route::group(['namespace' => 'customfield'], function () {
    Route::resource('customfields', 'CustomfieldsController');
    //For Datatable
    Route::post('customfields/get', 'CustomfieldsTableController')->name('customfields.get');
});
Route::group(['namespace' => 'department'], function () {
    Route::resource('departments', 'DepartmentsController');
    //For Datatable
    Route::post('departments/get', 'DepartmentsTableController')->name('departments.get');
});
Route::group(['namespace' => 'event'], function () {
    Route::get('events/load_events', 'EventsController@load_events')->name('events.load_events');
    Route::post('events/update_event', 'EventsController@update_event')->name('events.update_event');
    Route::post('events/delete_event', 'EventsController@delete_event')->name('events.delete_event');

    //For Datatable
    Route::post('events/get', 'EventsTableController')->name('events.get');
    Route::resource('events', 'EventsController');
});

Route::group(['namespace' => 'misc'], function () {
    Route::resource('miscs', 'MiscsController');
    //For Datatable
    Route::post('miscs/get', 'MiscsTableController')->name('miscs.get');
});
Route::group(['namespace' => 'note'], function () {
    Route::resource('notes', 'NotesController');
    //For Datatable
    Route::post('notes/get', 'NotesTableController')->name('notes.get');
});

Route::group(['namespace' => 'order'], function () {
    Route::resource('orders', 'OrdersController');
    //For Datatable
    Route::post('orders/get', 'OrdersTableController')->name('orders.get');
});

Route::group(['namespace' => 'prefix'], function () {
    Route::resource('prefixes', 'PrefixesController');
    //For Datatable
    Route::post('prefixes/get', 'PrefixesTableController')->name('prefixes.get');
});

Route::group(['namespace' => 'productcategory'], function () {
    Route::resource('productcategories', 'ProductcategoriesController');
    //For Datatable
    Route::post('productcategories/get', 'ProductcategoriesTableController')->name('productcategories.get');
});
Route::group(['namespace' => 'productvariable'], function () {
    Route::resource('productvariables', 'ProductvariablesController');
    //For Datatable
    Route::post('productvariables/get', 'ProductvariablesTableController')->name('productvariables.get');
});

Route::group(['namespace' => 'productVariable'], function () {
    Route::resource('product-variables', 'ProductVariableController');
    //For Datatable
    Route::post('product-variables/get', 'ProductVariableTableController')->name('productVariable.get');
});
Route::group(['namespace' => 'purchaseorder'], function () {
    Route::resource('purchaseorders', 'PurchaseordersController');
    //For Datatable
    Route::post('purchaseorders/get', 'PurchaseordersTableController')->name('purchaseorders.get');
});
Route::group(['namespace' => 'quote'], function () {
    Route::post('quotes/convert', 'QuotesController@convert')->name('quotes.convert');
    Route::post('quotes/quotes_status', 'QuotesController@update_status')->name('quotes.bill_status');
    Route::resource('quotes', 'QuotesController');
    //For Datatable
    Route::post('quotes/get', 'QuotesTableController')->name('quotes.get');

});
Route::group(['namespace' => 'template'], function () {
    Route::resource('templates', 'TemplatesController');
    //For Datatable
    Route::post('templates/get', 'TemplatesTableController')->name('templates.get');
});
Route::group(['namespace' => 'term'], function () {
    Route::resource('terms', 'TermsController');
    //For Datatable
    Route::post('terms/get', 'TermsTableController')->name('terms.get');
});

Route::group(['namespace' => 'transactioncategory'], function () {
    Route::resource('transactioncategories', 'TransactioncategoriesController');
    //For Datatable
    Route::post('transactioncategories/get', 'TransactioncategoriesTableController')->name('transactioncategories.get');
});

Route::group(['namespace' => 'gateway'], function () {
    Route::resource('usergatewayentries', 'UsergatewayentriesController');
    //For Datatable
    Route::post('usergatewayentries/get', 'UsergatewayentriesTableController')->name('usergatewayentries.get');
});
Route::group(['namespace' => 'warehouse'], function () {
    Route::resource('warehouses', 'WarehousesController');
    //For Datatable
    Route::post('warehouses/get', 'WarehousesTableController')->name('warehouses.get');
});
Route::group(['namespace' => 'country'], function () {
    Route::resource('countries', 'CountriesController');
    //For Datatable
    Route::post('countries/get', 'CountriesTableController')->name('countries.get');
});
Route::group(['namespace' => 'tax'], function () {
    Route::resource('taxes', 'TaxesController');
    //For Datatable
    Route::post('taxes/get', 'TaxesTableController')->name('taxes.get');
});
Route::group(['namespace' => 'unit'], function () {
    Route::resource('units', 'UnitsController');
    //For Datatable
    Route::post('units/get', 'UnitsTableController')->name('units.get');
});
Route::group(['namespace' => 'screens'], function () {
    Route::resource('screens', 'ScreensController');
    //For Datatable
    Route::post('screens/get', 'ScreensTableController')->name('screens.get');
});
Route::group(['namespace' => 'cost_centers'], function () {
    Route::get('/costcenters-all', 'CostCentersController@getAllCostCenters')->name('costcenters.all');
    Route::get('CostCentersByScreenID/{screen_id}', 'CostCentersController@CostCentersByScreenID')->name('CostCentersByScreenID');
    Route::get('getEmployeeData', 'CostCentersController@getEmployeeData')->name('getEmployeeData');
    Route::get('getCustomerData', 'CostCentersController@getCustomerData')->name('getCustomerData');
    Route::get('getSupplierData', 'CostCentersController@getSupplierData')->name('getSupplierData');
    Route::resource('costcenters', 'CostCentersController');
    //For Datatable
    Route::post('costcenters/get/{screen_id}', 'CostCentersTableController')->name('costcenters.get');
    Route::post('costcenters/get', 'CostCentersAllTableController')->name('allCostcenters.get');
});
Route::group(['namespace' => 'subtax'], function () {
    Route::resource('subtaxes', 'SubTaxesController');
    //For Datatable
    Route::post('subtaxes/get', 'SubTaxesTableController')->name('subtaxes.get');
});
//Route::group(['namespace' => 'globalSetting'], function () {
//    Route::resource('globalsettings', 'GlobalSettingsController');
//    //For Datatable
//    Route::post('globalsettings/get', 'GlobalSettingsController')->name('globalsettings.get');
//});
