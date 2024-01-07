<?php

namespace App\Http\Controllers;

use App\Models\rombel;
use Illuminate\Http\Request;

class RombelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rombels = Rombel::simplePaginate(5);
        return view('administrasi.rombels.index', compact('rombels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administrasi.rombels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rombel' => 'required|unique:rombels'
        ]);

        Rombel::create([
            'rombel' => $request->rombel
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(rombel $rombel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rombels = Rombel::find($id); 
        return view('administrasi.rombels.edit', compact('rombels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'rombel' => 'required|unique:rombels'
        ]);

        Rombel::where('id', $id)->update([
            'rombel' => $request->rombel
        ]);

        return redirect()->route('rombel.index')->with('success', 'Berhasil mengubah data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        try {
            Rombel::where('id', $id)->delete();
            return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
         } 
         catch(\Illuminate\Database\QueryException $ex) {
            if($ex->getCode() === '23000') {
                return redirect()->back()->with('gagal', 'Tidak dapat menghapus data!');
            } 
         }
        

        
    }

    public function cari(Request $request)
	{
		$cari = $request->cari;
 
		$rombels = rombel::where('rombel','like',"%".$cari."%")->simplePaginate(5);
 
		return view('administrasi.rombels.index', compact('rombels'));
 
	}
}
