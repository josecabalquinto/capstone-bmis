<?php

namespace App\Http\Controllers;

use App\Models\Purok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurokController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index()
    {
        $data = array(
            'puroks'    =>  Purok::all()
        );
        return view('puroks.index', $data);
    }

    public function create()
    {
        return view('puroks.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'purok' => 'required|unique:puroks,purok'
        ]);

        $data = array(
            'purok' =>  strtolower($request->purok),
            'added_by' => Auth::user()->name
        );
        Purok::create($data);
        return redirect()->back()->with('create', 1);
    }

    public function destroy(Purok $purok)
    {
        $purok->delete();
        return redirect()->back()->with('destroy', 1);
    }
}
