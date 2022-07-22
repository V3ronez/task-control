<?php

namespace App\Mail;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewTaskEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $task;
    protected $data_to_conclusion;
    protected $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Task $task)
    {
        $this->task = $task->task;
        $this->data_to_conclusion = date('d/m/Y', strtotime($task->date_to_conclusion));
        $this->url = 'http://localhost:8000/task/' . $task->id;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.new-task', [
            'task' => $this->task,
            'data_to_conclusion' => $this->data_to_conclusion,
            'url' => $this->url,
        ])->subject('Nova tarefa criada');
    }
}
