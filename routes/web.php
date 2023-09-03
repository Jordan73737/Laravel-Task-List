<?php

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
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
        'tasks' => Task::latest()->paginate(10)
    ]);
})->name('tasks.index');

// linked this route to create.blade.php laravel form page
Route::view('/tasks/create', 'create')
    ->name('tasks.create');

// EDIT FORM //
Route::get('/tasks{task}/edit', function (Task $task) {
    return view('edit', [
        'task' => $task
    ]);
})->name('tasks.edit');

// routes that show one element should have the 'show' suffix
Route::get('/tasks{task}', function (Task $task) {
    return view('show', [
        'task' => $task
    ]);
})->name('tasks.show');

// Sanitize and Validate User Input 
// when you call 'request - validate' method it will use data sent through the form
// to validate it, will use the keys from validate array 
// 'title', 'desc' and 'long_desc' to check those fields against the specific
// validation rules (ie 'required max 255 words)
// if everything passes youll get data array with the title and desc's sent through the form.
// If it fails, laravel will send user to the last page 
Route::post('/tasks', function (TaskRequest $request) {
// create new task upon inputting correct data and pressing add task
        $task = Task::create($request->validated());
// model is created in memory but not saved in database, therefore we do:
        // $task->save();
// redirect to newly added tasks page 
        return redirect()->route('tasks.show', ['task' => $task->id])
            // one time flash message on being redirected to tasks page after adding task
            ->with('success', 'Task created successfully!');
})->name('tasks.store');

// Endpoint for Edit Form //
Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {
        $task->update($request->validated());

        return redirect()->route('tasks.show', ['task' => $task->id])
            ->with('success', 'Task updated successfully!');
})->name('tasks.update');

Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete();

    return redirect()->route('tasks.index')
    ->withj('success', 'Task delete successfully!');
})->name('tasks.destroy');

Route::put('tasks/{task}/toggle-complete', function(Task $task) {

    $task->toggleComplete();

    return redirect()->back()->with('success', 'Task updated successfully!');
})->name('tasks.toggle-complete');



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
    return 'you have wandered into nowhere...you should click away';
});

