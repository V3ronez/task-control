<?php

namespace App\Exports;

use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TasksExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Auth::user()->tasks()->get();
    }

    public function headings(): array
    {
        return [
            'ID taks',
            'ID user',
            'Task',
            'Date to conclusion',
            'Date create',
            'Date update',
        ];
    }

    public function map($data): array
    {
        return [
            $data->id,
            $data->user_id,
            $data->task,
            date('d/m/Y', strtotime($data->date_to_conclusion)),
            date('d/m/Y', strtotime($data->created_at)),
            date('d/m/Y', strtotime($data->updated_at)),
        ];
    }
}
