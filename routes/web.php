<?php

use Illuminate\HTTP\Response;
use Illuminate\HTTP\Request;
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
    return redirect()->route('tasks.index');
});


// routes that show list of elements should have the 'index' suffix
// routes should have common prefix eg 'tasks'
Route::get('/tasks', function () {
    return view('index', [
        'tasks' => \App\Models\Task::latest()->get()
    ]);
})->name('tasks.index');


Route::view('/tasks/create', 'create')
    ->name('tasks.create');

// routes that show one element should have the 'show' suffix
Route::get('/tasks{id}', function ($id) {
    return view('show', [
        'task' => \App\Models\Task::findOrFail($id)
    ]);
})->name('tasks.show');

Route::post('/tasks', function (Request $request) {
    dd($request->input());
})->name('tasks.store');

// // new url
// Route::get('/hello', function () {
//     return 'Hello';
// })->name('hello');

// // old url to be redirected to new url above
// Route::get('/hallo', function () {
//     return redirect()->route('hello');
// });


// Route::get('greet/{name}', function ($name) {
//     return 'Hello ' . $name . '!';
//     });

// Generic Route page that you go to 
// if you try to enter a route that doesn't exist

// Get
// Post
// Put
// Delete

Route::fallback(function () {
    return 'Welcome to the whitespace';
});

