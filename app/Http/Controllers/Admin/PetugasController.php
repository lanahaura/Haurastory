<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function index() {
        $petugas = Petugas::latest()->paginate(10);
        return view('admin.petugas.index', compact('petugas'));
    }

    public function create() { return view('admin.petugas.create'); }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'username' => ['required','string','max:50','unique:petugas,username'],
            'password' => ['required','string','min:6'],
        ]);
        $data['password'] = Hash::make($data['password']);
        Petugas::create($data);
        return redirect()->route('admin.petugas.index')->with('success','Petugas ditambahkan.');
    }

    public function edit(Petugas $petuga) {
        return view('admin.petugas.edit', ['petugas' => $petuga]);
    }

    public function update(Request $request, Petugas $petuga) {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'username' => ['required','string','max:50','unique:petugas,username,'.$petuga->id],
            'password' => ['nullable','string','min:6'],
        ]);

        if (!empty($data['password'])) $data['password'] = Hash::make($data['password']);
        else unset($data['password']);

        $petuga->update($data);

        return redirect()->route('admin.petugas.index')->with('success','Petugas diperbarui.');
    }

    public function destroy(Petugas $petuga) {
        $petuga->delete();
        return back()->with('success','Petugas dihapus.');
    }
}
