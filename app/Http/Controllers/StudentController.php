<?php

namespace App\Http\Controllers;

use App\Models\Rayon;
use App\Models\rombel;
use App\Models\student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $students = Student::simplePaginate(5);
        } elseif (Auth::user()->role == 'ps') {
            $students = Student::where('rayon_id', '=', session('rayon_id'))->simplePaginate(5);
        }

        return view('administrasi.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rombels = rombel::all();
        $rayons = Rayon::all();
        return view('administrasi.students.create', compact('rombels', 'rayons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nis' => 'required|min:3|unique:students',
            'name' => 'required',
            'rombel_id' => 'required',
            'rayon_id' => 'required',
        ]);

        Student::create([
            'nis' => $request->nis,
            'name' => $request->name,
            'rombel_id' => $request->rombel_id,
            'rayon_id' => $request->rayon_id,
        ]);
        //atau jika seluruh data input akan dimasukkan langsung ke db bisa dengan perintah medicine::create($request->all());

        return redirect()->back()->with('success', 'Berhasil menambahkan data !');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $students = Student::find($id);
        $rombels = rombel::all();
        $rayons = rayon::all();

        return view('administrasi.students.edit', compact('students', 'rombels', 'rayons'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'nis' => 'required',
            'name' => 'required',
            'rombel_id' => 'required',
            'rayon_id' => 'required',
        ]);

        Student::where('id', $id)->update([
            'nis' => $request->nis,
            'name' => $request->name,
            'rombel_id' => $request->rombel_id,
            'rayon_id' => $request->rayon_id,
        ]);

        return redirect()->route('student.index')->with('success', 'Berhasil mengubah data !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        try {
            student::where('id', $id)->delete();
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
            $students = student::where('name','like',"%".$cari."%")->simplePaginate(5);
        } elseif (Auth::user()->role == 'ps') {
            $students = student::where('name','like',"%".$cari."%")->where('rayon_id','=', session('rayon_id'))->simplePaginate(5);
        }
         
		return view('administrasi.students.index', compact('students'));
 
	}
}
