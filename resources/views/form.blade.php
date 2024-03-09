@extends('layouts.app')

@section('title', isset($task) ? 'Edit Task' : 'Add Task')
    
@section('content')
    <form action="{{ isset($task) ? route('tasks.update', ['task' => $task->id]) : route('tasks.store') }}" method="POST">
        @csrf
        @isset($task)
            @method('PUT')
        @endisset
        <div class="mb-4">
            <label for="title">Title</label>
            <input type="text" name="title" id="title"
            @class(['border-red-500' => $errors->has('title')]) value="{{ $task->title ?? old('title') }}">
            @error('title')
                <p class="error">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="5" @class(['border-red-500' => $errors->has('description')])>{{ $task->description ?? old('description') }}</textarea>
            @error('description')
                <p class="error">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="long_description">Long Description</label>
            <textarea name="long_description" id="long_description" rows="10" @class(['border-red-500' => $errors->has('long_description')])>{{ $task->long_description ?? old('long_description') }}</textarea>
            @error('long_description')
                <p class="error">{{$message}}</p>
            @enderror
        </div>

        <div class="flex gap-2 items-center flex-row-reverse justify-between">
            <button type="submit" class="btn bg-lime-400 hover:bg-lime-500">
                @isset($task)
                    &uarr; Update Task
                @else
                    &plus; Add Task
                @endisset
            </button>
            <a href="{{route('tasks.index')}}" class="link">&larr; Cancel</a>
        </div>
    </form>
@endsection