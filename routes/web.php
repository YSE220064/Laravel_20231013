<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Route::get('/about', function () {
    //return "ABOUTTO!";
    //return view("about");
//});

Route::get("/about", [HomeController::class, "about"]
);

Route::get('/item/{id}', function ($id) {
    $message = "Aitemu no Aidi wa; {$id}";
    return $message;
});

// //Google検索みたいなルーティング
// Route::get('/search', function (Request $request) {
//     //dd($request);
//     // $keyword = $request->q;
//     // $message = "キーワードは{$keyword}です";

//     //連想配列データ
//     $data = [
//         'keyword' => $request->q
//     ];
//     // Viewファイルにデータを渡す
//     return view('search', $data);
// })->middleware(['auth', 'verified'])->name('search');


require __DIR__.'/auth.php';

Route::get('/okaimono', function () {
    return view('okaimono');
});

Route::get('/okaimono', function () {
    return view('okaimono');
})->middleware(['auth', 'verified'])->name('okaimono');

Route::get("/search", [HomeController::class, "search"]
);