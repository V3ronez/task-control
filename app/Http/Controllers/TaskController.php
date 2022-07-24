<?php

namespace App\Http\Controllers;

use App\Exports\TasksExport;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class TaskController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::user()->id;
        $tasks = Task::where('user_id', $user)->paginate(10);

        return view('task.index', ['tasks' => $tasks]);

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

        $userId = $request->all();
        $userId['user_id'] = Auth::user()->id;
        $task = Task::create($userId);
        //send email to confirm new task
        // $toDestination = Auth::user()->email;
        // Mail::to($toDestination)->send(new NewTaskEmail($task));
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
        if ($task->user_id !== Auth::user()->id) {
            return view('access-denied');
        }

        return view('task.edit', ['task' => $task]);
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
        if ($task->user_id !== Auth::user()->id) {
            return view('access-denied');
        }

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
        $task->update($request->all());

        return redirect()->route('task.show', ['task' => $task->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::user()->id) {
            return view('access-denied');
        }

        $task->delete();
        return redirect()->route('task.index');

    }

    public function export($extension)
    {
        if (in_array($extension, ['xlsx', 'csv'])) {
            $fileName = sprintf('tasks.%s', $extension);
            return Excel::download(new TasksExport, $fileName);
        }
        return redirect()->route('task.index');

    }
}
