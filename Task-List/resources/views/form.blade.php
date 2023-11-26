@extends('layouts.app')

@section('title', isset($task) ? 'Edit Task' : 'Create a new task')

@section('content')
    <div class="mb-4">
        <a href="{{ route('task.index') }}">
            <button class="link">← Return Home</button>
        </a>
    </div>

    <form method="POST" action="{{ isset($task) ? route('task.update', ['task' => $task->id]) : route('task.store') }}">
        @csrf
        @isset($task)
            @method('PUT')
        @endisset
        <div class="mb-4">
            <label for="title">
                Title
            </label>
            <input type="text" name="title" id="title"
             @class(['border-red-500' => $errors->has('title')])
             value="{{ $task->title ?? old('title') }}">
            @error('title')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="desc">Description</label>
            <textarea name="desc" id="desc" rows="5" @class(['border-red-500' => $errors->has('desc')])>
                {{ $task->desc ?? old('desc') }}
            </textarea>
            @error('desc')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="longDesc">Long Description</label>
            <textarea name="longDesc" id="longDesc" rows="10" @class(['border-red-500' => $errors->has('longDesc')])>
                {{ $task->longDesc ?? old('longDesc') }}
            </textarea>
            @error('longDesc')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn mt-4">
            @isset($task)
                Edit Task
            @else
                Create New Task
            @endisset
        </button>
    </form>
@endsection