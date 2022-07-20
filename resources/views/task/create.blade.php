@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">New task</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('task.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">New task</label>
                                <input type="text" name="task" value="{{ old('task') ? old('task') : '' }}"
                                    class="form-control" aria-describedby="emailHelp">
                                {{ $errors->has('task') ? $errors->first('task') : '' }}
                                <div id="emailHelp" class="form-text">add New task</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Date conclusion</label>
                                <input type="date" name="date_to_conclusion" class="form-control">
                                {{ $errors->has('date_to_conclusion') ? $errors->first('date_to_conclusion') : '' }}
                            </div>
                            <button type="submit" class="btn btn-primary">Add new task</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
