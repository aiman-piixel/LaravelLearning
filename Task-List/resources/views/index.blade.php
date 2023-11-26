@extends('layouts.app')

@section('title', 'Task List Dashboard')

@section('content')
    <nav class="mb-4 mt-2">
        <a href="{{ route('task.create') }}">
            <button class="link">Create New Task</button>
        </a>
    </nav>

    @forelse ($tasks as $task)
        <div>
            <a href="{{ route('task.show', ['task' => $task->id]) }}"
                @class(['line-through' => $task->completed])>{{ $task->title }}</a>
        </div>
    @empty
        <div>There is no tasks!</div>
    @endforelse

    @if ($tasks->count())
        <nav class="mt-4">
            {{ $tasks->links() }}
        </nav>
    @endif
@endsection