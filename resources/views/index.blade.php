@extends('layouts.app')

@section('title', 'The list of tasks')

@section('content')
  <!-- @if(count($tasks)) -->
  <!-- for else displays all elements on the list, if there are any -->
  <!-- if the list is empty you then display the alternative -->
    @forelse($tasks as $task)
      <div>
         <!-- URL link to other pages by passing route function, 
        followed by route name eg route('tasks.show',
        and route parameters as the second argument eg ['id' => $task->id] -->
        <a href="{{ route('tasks.show', ['id' => $task->id]) }}">{{ $task->title }}</a>
      </div>
    @empty
    <div>There are no tasks!</div>
    @endforelse
  <!-- @endif -->
@endsection
