@extends('layouts.app')

@section('content')
    <table class="table table-dark table-striped text-center">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Task</th>
                <th scope="col">Date to conclusion</th>
                <th scope="col"></th>
                <th scope="col"><a style="text-decoration: none" class="btn btn-light"
                        href="{{ route('task.export', ['extension' => 'xlsx']) }}">Export(XLSX)</a></th>
                <th scope="col"><a style="text-decoration: none" class="btn btn-light"
                        href="{{ route('task.export', ['extension' => 'csv']) }}">Export(CSV)</a></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <th scope="row-auto">{{ $task->id }}</th>
                    <td>{{ $task->task }}</td>
                    <td>{{ date('d/m/Y', strtotime($task->date_to_conclusion)) }}</td>
                    <td><a style="text-decoration: none" class="btn btn-light"
                            href="{{ route('task.edit', ['task' => $task->id]) }}">Edit task</a></td>
                    <td>
                        <form id="form_{{ $task->id }}" action="{{ route('task.destroy', ['task' => $task->id]) }}"
                            method="post">
                            @method('DELETE')
                            @csrf
                        </form>
                        <a style="text-decoration: none" class="btn btn-light"
                            onclick="document.getElementById('form_{{ $task->id }}').submit()" href="#">Delete</a>
                    </td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-grid gap-2 col-5 mx-auto">
        <a href="{{ url()->previous() }}" class="btn btn-dark">Back</a>
        <a href="{{ route('task.create') }}" class="btn btn-dark">Create new task</a>
    </div>
    <nav style="margin-top:20px">
        <ul class="pagination justify-content-center">
            <li class="page-item">
                <a class="page-link" href="{{ $tasks->previousPageUrl() }}">Previous</a>
            </li>
            @for ($i = 1; $i <= $tasks->lastPage(); $i++)
                <li class="page-item {{ $tasks->currentPage() == $i ? 'active' : '' }}"><a class="page-link"
                        href="{{ $tasks->url($i) }}">{{ $i }}</a></li>
            @endfor
            <li class="page-item">
                <a class="page-link" href="{{ $tasks->nextPageUrl() }}">Next</a>
            </li>
        </ul>
    </nav>
@endsection
