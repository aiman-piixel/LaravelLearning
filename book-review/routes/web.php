<?php

use \App\Models\Book;
use Illuminate\Support\Facades\Route;


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
    dd();
});

Route::get('/index', function () {
    return view('index', [ 'books'=> Book::with('reviews')->orderBy('created_at', 'asc')->paginate(10) ]);
})->name('book.index');
