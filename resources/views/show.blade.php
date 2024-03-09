@extends('layouts.app')

@section('title', $task->title)

@section('content')
    <div class="mb-4">
        <a href="{{route('tasks.index')}}" class="link">&larr; Go back to the task list</a>
    </div>

    <p class="mb-4 text-slate-700">{{$task->description}}</p>

    @if ($task->long_description)
        <p class="mb-4 text-slate-700">{{$task->long_description}}</p>
    @endif

    <p class="mb-4 text-sm text-slate-500">Created {{$task->created_at->diffForHumans()}} &bull; Updated {{$task->updated_at->diffForHumans()}}</p>

    <p class="mb-4">
        @if ($task->completed)
            <span class="font-medium text-green-500">Completed</span>
        @else
            <span class="font-medium text-red-500">Not completed</span>
        @endif
    </p>

    <div class="flex justify-between gap-2">
        <a href="{{ route('tasks.edit', ['task' => $task->id]) }}" class="btn bg-amber-400 hover:bg-amber-500">✏ Edit</a>

        <form method="POST" action="{{route('tasks.toggle-complete', ['task' => $task])}}" class="mr-auto">
            @csrf
            @method('PUT')
            <button type="submit" 
            @class(['btn', 'bg-rose-300' => $task->completed, 'hover:bg-rose-400' => $task->completed,'bg-lime-400' => !$task->completed, 'hover:bg-lime-500' => !$task->completed ])>
            @if ($task->completed)
                &times;
            @else
                &check;
            @endif
            Mark as {{ $task->completed ? 'not completed' : 'completed' }}</button>
        </form>

        <form action="{{route('task.destroy', ['task' => $task->id])}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn bg-red-700  hover:bg-red-800" style="color: #fff">
                🗑 Delete
            </button>
        </form>
    </div>
@endsection