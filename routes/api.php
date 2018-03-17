<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

/*
 * Testing REST Endpoints
 */
Route::group(['prefix' => 'v1/ptp/test'], function () {
    Route::get('transaction/{transactionId}', 'Pse@getTransactionInformation');
    Route::get('bank', 'Pse@getBankList');
    Route::post('transaction', 'Pse@createTransaction');
    Route::post('transactionmulticredit', 'Pse@createTransactionMulticredit');
});
