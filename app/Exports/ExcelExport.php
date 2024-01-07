<?php

namespace App\Exports;

use App\Models\late;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExcelExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {


        if (Auth::user()->role == 'admin') {
            return late::with('student', 'student.rayon', 'student.rombel')
                ->select('student_id', DB::raw('COUNT(id) as totalLate'))
                ->groupBy('student_id')
                ->get();
        } elseif (Auth::user()->role == 'ps') {
            return late::with('student', 'student.rayon', 'student.rombel')
                ->select('student_id', DB::raw('COUNT(id) as totalLate'))
                ->whereHas('student', function ($query) {
                    return $query->where('rayon_id', '=', session('rayon_id'));
                })
                ->groupBy('student_id')
                ->get();
        }
    }

    public function headings(): array
    {
        return [
            "NIS", "Nama", "Rombel", "Rayon", "Total Keterlambatan"
        ];
    }

    public function map($late): array
    {
        return [
            $late->student->nis,
            $late->student->name,
            $late->student->rombel->rombel,
            $late->student->rayon->rayon,
            $late->totalLate

        ];
    }
}
