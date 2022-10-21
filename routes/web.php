<?php

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/todos', function() {
    return Todo::all();
})->name('todos.all');

Route::post('/todos', function(Request $request) {
    return Todo::create($request->all());
})->name('todos.create');

Route::put('/todos/complete', function() {
    Todo::query()->update(['done' => true]);
})->name('todos.complete');

Route::put('/todos/{todo}', function(Todo $todo) {
    $todo->toggleDone()->update();
})->name('todos.toggle');

Route::delete('/todos/{todo}', function(Todo $todo) {
    $todo->delete();
})->name('todos.remove');
