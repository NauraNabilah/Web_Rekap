<?php

namespace App\Http\Controllers;

use Excel;
use App\Models\late;
use App\Models\student;
use Barryvdh\DomPDF\PDF;
use App\Exports\ExcelExport;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Else_;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;

class LateController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        if (Auth::user()->role == 'admin') {
            $lates = Late::with('student')->simplePaginate(5);
            $rekap = late::with('student')->select('id', 'student_id', DB::raw('count(*) as jumlah_keterlambatan'))
                ->groupBy('student_id')
                ->simplePaginate(5);
        } elseif (Auth::user()->role == 'ps') {
            $lates = Late::whereHas('student', function ($query) {
                return $query->where('rayon_id', '=', session('rayon_id'));
            })->simplePaginate(5);
            $rekap = late::with('student')->select('id', 'student_id', DB::raw('count(*) as jumlah_keterlambatan'))
                ->whereHas('student', function ($query) {
                    return $query->where('rayon_id', '=', session('rayon_id'));
                })->groupBy('student_id')
                ->simplePaginate(5);
        }


        return view('administrasi.lates.index', compact('lates', 'rekap'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = student::all();
        return view('administrasi.lates.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'date_time_late' => 'required',
            'information' => 'required',
            'bukti' => 'required|mimes:jpeg,png,jpg,pdf|max:2048',

        ]);

        $lateData = [
            'student_id' => $request->student_id,
            'date_time_late' => $request->date_time_late,
            'information' => $request->information,
        ];

        if ($request->file('bukti')->isValid()) {
            $file = $request->file('bukti');
            $path = $file->store('bukti', 'public'); // 'public' is the disk name defined in filesystem.php

            $lateData['bukti'] = $path;
        }

        Late::create($lateData);

        return redirect()->route('late.index')->with('success', 'Berhasil menambahkan data!');
    }

    public function detail(string $student_id)
    {
        $lates = Late::with('student')->where('student_id', $student_id)->orderBy('date_time_late', 'asc')->get();
        $students = student::with('rombel', 'rayon')->find($student_id);
        if (!$lates) {
            return redirect()->route('late.index')->with('gagal', 'Data tidak ditemukan ' . $student_id);
        }

        return view('administrasi.lates.detail', compact('lates', 'students'));
    }

    /**
     * Display the specified resource.
     */
    public function show(late $late)
    {
        //
    }

    public function showPrint($id)
    {
        $lates = Late::find($id);
        if ($id) {
            return view('administrasi.lates.print', compact('lates'));
        }

        $lates = Late::with('student')->simplePaginate(10);
        return view('administrasi.lates.print', compact('lates'));
    }

    public function downloadPDF($id)
    {
        // $lates = Late::find($id)->toArray();

        $lates = Late::find($id);

        view()->share('lates', $lates);
        $pdf = \PDF::loadView('administrasi.lates.download-pdf', compact('lates'));
        return $pdf->download('surat keterlambatan.pdf');
    }

    public function exportExcel()
    {
        $fileName = 'data_keterlambatan.xlsx';
        return Excel::download(new ExcelExport, $fileName);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $lates = Late::find($id); //sama dengan user::where('id', $id)->first()
        $lates = Late::with('student')->find($id);
        $students = student::all();

        return view('administrasi.lates.edit', compact('lates', 'students'));
    }

    /**
     * Update the specified resource in storage. 
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'date_time_late' => 'required',
            'information' => 'required'
        ]);

        if ($request->file('bukti')->isValid()) {
            $request->validate([
                'bukti' => 'required|mimes:jpeg,png,jpg,pdf|max:2048'
            ]);

            $file = $request->file('bukti');
            $path = $file->store('bukti', 'public');

            Late::where('id', $id)->update([
                'date_time_late' => $request->date_time_late,
                'information' => $request->information,
                'bukti' => $path
            ]);
        } else {
            Late::where('id', $id)->update([
                'date_time_late' => $request->date_time_late,
                'information' => $request->information
            ]);
        }

        return redirect()->route('late.index')->with('success', 'Berhasil mengubah data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $lates = Late::find($id);
            $filePath = $lates->bukti;

            Late::where('id', $id)->delete();

            // Check if the file exists
            if (Storage::disk('public')->exists($filePath)) {
                // Delete the file
                Storage::disk('public')->delete($filePath);
            }

            return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
        } catch (\Illuminate\Database\QueryException $ex) {
            if ($ex->getCode() === '23000') {
                return redirect()->back()->with('gagal', 'Tidak dapat menghapus data!');
            }
        }
    }

    public function cari(Request $request)
    {
        $cari = $request->cari;

        if (Auth::user()->role == 'admin') {
            $lates = late::where('information', 'like', "%" . $cari . "%")
            ->simplePaginate(5);

            $rekap = late::select('id', 'student_id', DB::raw('count(*) as jumlah_keterlambatan'))
            ->where('information', 'like', "%" . $cari . "%")
            ->groupBy('student_id')
            ->simplePaginate(5);
        
        } elseif (Auth::user()->role == 'ps') {
            $lates = late::where('information', 'like', "%" . $cari . "%")
            ->whereHas('student', function ($query) {
                return $query->where('rayon_id', '=', Session('rayon_id'));
            })->simplePaginate(5);

            $rekap = late::select('id', 'student_id', DB::raw('count(*) as jumlah_keterlambatan'))
            ->where('information', 'like', "%" . $cari . "%")
            ->whereHas('student', function ($query) {
                return $query->where('rayon_id', '=', Session('rayon_id'));
            })->groupBy('student_id')
            ->simplePaginate(5);

        }

        return view('administrasi.lates.index', compact('lates', 'rekap'));
    }
}
