<?php

use App\Http\Requests\TaskRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

Route::get('/tasks', function (){
    return view('index', [
        'tasks' => \App\Models\Task::orderBy('updated_at', 'desc')->paginate(10) 
        //use ::get for more detailed queries, use ::all to call every rows, use ::paginate to use pages
    ]);
})->name('task.index');

Route::view('/tasks/create', 'create')->name('task.create');

Route::get('/tasks/{task}/edit', function (\App\Models\Task $task){
    return view('edit', [
        'task' => $task
    ]);
})->name('task.edit');

Route::get('/tasks/{task}', function (\App\Models\Task $task){
    return view('show', [
        'task' => $task
    ]);
})->name('task.show');

Route::post('/tasks', function(TaskRequest $request) {
    $task = \App\Models\Task::create($request->validated());

    return redirect()->route('task.show', ['task' => $task->id])->with('success','Task created successfully!');
})->name('task.store');

Route::put('/tasks/{task}', function(\App\Models\Task $task, TaskRequest $request) {
    $task->update($request->validated());

    return redirect()->route('task.show', ['task' => $task->id])->with('success','Task edited successfully!');
})->name('task.update');

Route::delete('/tasks/{task}', function(\App\Models\Task $task){
    $task->delete();

    return redirect()->route('task.index')->with('success','Task deleted Successfully');
})->name('task.destroy');

Route::put('/tasks/{task}/toggle-complete', function(\App\Models\Task $task){
    $task->toggleComplete();
    return redirect()->back()->with('success', 'Task updated successfully');
})->name('task.toggleComplete');

Route::get('/', function () {
    return redirect()->route('task.index');
});

Route::fallback(function (){
    return 'Sorry. Page does not exist';
});