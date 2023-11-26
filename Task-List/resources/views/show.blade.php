@extends('layouts.app')

@section('title', $task->title)

@section('content')
    <div class="mb-4">
        <a href="{{ route('task.index') }}">
            <button class="link">← Return Home</button>
        </a>
    </div>


    <p class="mb-1 text-lg font-semibold">Task Descriptions:</p>
    <p class="mb-4 text-slate-700">{{ $task ->desc }}</p>

    @if ($task ->longDesc)
        <p class="mb-1 text-lg font-semibold">Detailed Descriptions:</p>
        <p class="mb-4 text-slate-700">{{ $task ->longDesc }}</p>
    @endif

    <div class="mb-4 font-style: italic">
        @if ($task ->completed === 1)
            ✔️ Completed
        @else
            ⨯ Not Complete
        @endif
    </div>

    <p class="text-sm mb-1 font-style: italic">Created at: {{ $task ->created_at->diffForHumans() }}</p>
    <p class="text-sm mb-4 font-style: italic">Updated at: {{ $task ->updated_at->diffForHumans() }}</p>

    <div class="flex gap-2">
        <a href="{{ route('task.edit', ['task' => $task->id]) }}" class="btn">
            <button>Edit</button>
        </a>
 
        <form method="POST" action="{{ route('task.toggleComplete', ['task' => $task]) }}">
            @csrf
            @method('PUT')
            <button type="submit" class="btn">
                Mark as {{ $task->completed ? 'not complete' : 'complete' }}
            </button>
        </form>

        <form action="{{ route('task.destroy', ['task' => $task->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn">Delete This Task</button>
        </form>
    </div>
@endsection