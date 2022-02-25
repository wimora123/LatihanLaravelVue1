<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/getContacts', [ContactController::class, 'getContacts'])->name('getContacts');

Route::post('/save_contact', [ContactController::class, 'saveContact'])->name('saveContact');

Route::get('/getIDContact/{id}', [ContactController::class, 'getIDContact']);
Route::post('/updateContact/{id}', [ContactController::class, 'updateContact']);

Route::delete('/delete_contact/{id}', [ContactController::class, 'deleteContact']);