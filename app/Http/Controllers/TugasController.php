<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Http\Request;

class TugasController extends Controller
{
    public function index()
    {
        return view('tugas');
    }

    public function getData(){
        return response()->json(Tugas::all());
    }

    public function store(Request $request)
    {
        $tugas = Tugas::create($request->all());
        return response()->json(['success' => true, 'tugas' => $tugas]);
    }

    public function edit($id)
    {
        return response()->json(Tugas::find($id));
    }

    public function update(Request $request, $id)
    {
        $tugas = Tugas::find($id);
        $tugas->update($request->all());
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        Tugas::destroy($id);
        return response()->json(['success' => true]);
    }
}
