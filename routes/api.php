<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ReadingMaterialController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_middleware'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Reading Materials Routes
Route::get('/reading-materials/{grade}/{subject}', [ReadingMaterialController::class, 'getByGradeAndSubject']);
Route::post('/reading-materials/{id}/publish', [ReadingMaterialController::class, 'publish'])->name('reading-materials.publish'); 