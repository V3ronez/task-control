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
            <tr>
                <th scope="row-auto">{{ $task->id }}</th>
                <td>{{ $task->task }}</td>
                <td>{{ date('d/m/Y', strtotime($task->date_to_conclusion) )}}</td>
            </tr>
        </tbody>
    </table>
    <div class="d-grid gap-2 col-5 mx-auto">
        <a href="{{ url()->previous() }}" class="btn btn-dark">Back</a>
        <a href="{{ route('task.index') }}" class="btn btn-dark">All tasks</a>
    </div>
@endsection
