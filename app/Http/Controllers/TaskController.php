<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (Auth::check()) {
        //     $id = Auth::user()->id;
        //     $email = Auth::user()->email;
        //     echo Auth::user();
        //     echo '<br>';
        //     return "ID: $id | Email: $email";
        // }
        // return 'voce está deslogado';

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'task' => 'required|max:200|min:5',
            'date_to_conclusion' => 'required|date',
        ];
        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido',
            'task.max' => 'O campo :attribute deve ter no máximo 200 caracteres',
            'task.min' => 'O campo :attribute deve ter no mínimo 5 caracteres',
            'date_to_conclusion.date' => 'Insira uma data válida',
            'date_to_conclusion.required' => 'O campo date conclusion debe ser preenchido',
        ];

        $request->validate($rules, $feedback);
        $task = Task::create($request->all());
        return redirect()->route('task.show', ['task' => $task->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $task = $task->getAttributes();
        return view('task.show', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
