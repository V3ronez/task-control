@component('mail::message')
    # {{ $task }}
    Date to finish this task: {{ $data_to_conclusion }}
    @component('mail::button', ['url' => $url])
        Click to view the new task.
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
