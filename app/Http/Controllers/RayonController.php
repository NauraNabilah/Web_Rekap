<?php

namespace App\Http\Controllers;

use App\Models\rayon;
use App\Models\User;
use Illuminate\Http\Request;

class RayonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rayons = Rayon::with('user')->simplePaginate(5);
        return view('administrasi.rayons.index', compact('rayons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('administrasi.rayons.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rayon' => 'required',
            'user_id' => 'required',
            
        ]);

        Rayon::create([
            'rayon' => $request->rayon,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('rayon.store')->with('success', 'Berhasil menambahkan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(rayon $rayon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $users = User::all();
        $rayons = Rayon::with('user')->find($id); 
        return view('administrasi.rayons.edit', compact('rayons', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'rayon' => 'required',
            'user_id' => 'required'
        ]);

        Rayon::where('id', $id)->update([
            'rayon' => $request->rayon,
            'user_id' => $request->user_id
        ]);

        return redirect()->route('rayon.index')->with('success', 'Berhasil mengubah data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            rayon::where('id', $id)->delete();
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
 
		// $rayons = Rayon::with('user')->where('rayon','like',"%".$cari."%")->paginate();
        $rayons = Rayon::with('user')
        ->where('rayon', 'like', "%" . $cari . "%")
        ->whereHas('user', function ($query) use ($cari) {
            $query->where('name', 'like', "%" . $cari . "%");
        })
        ->simplePaginate(5);
    
		return view('administrasi.rayons.index', compact('rayons'));
 
	}
}
