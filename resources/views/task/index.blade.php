@extends('layouts.app')

@section('content')
    <table class="table table-dark table-striped text-center">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Task</th>
                <th scope="col">Date to conclusion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
           
            <tr>
                <th scope="row-auto">{{ $task->id }}</th>
                <td>{{ $task->task }}</td>
                <td>{{ $task->date_to_conclusion }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-grid gap-2 col-5 mx-auto">
        <a href="{{ url()->previous() }}" class="btn btn-dark">Back</a>
        <a href="{{ route('task.create') }}" class="btn btn-dark">Create new task</a>
    </div>
@endsection
