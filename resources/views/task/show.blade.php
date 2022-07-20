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
                <th scope="row-auto" >{{ $task['id'] }}</th>
                <td>{{ $task['task']  }}</td>
                <td>{{ $task['date_to_conclusion']  }}</td>
            </tr>
        </tbody>
    </table>
@endsection
