<?php

namespace App\Http\Controllers;

use App\Models\Vitamin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VitaminController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index()
    {
        $data = array(
            'vitamins' =>  Vitamin::all()
        );


        return view('vitamins.index', $data);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'vitamin' => 'required|string|unique:vitamins,vitamin',
            'description' => 'required|string'
        ]);

        $data = array(
            'vitamin' =>  strtolower($request->vitamin),
            'description' =>  strtolower($request->description),
            'added_by' => Auth::user()->name
        );

        Vitamin::create($data);
        return redirect()->back()->with('create', 1);
    }

    public function destroy(Vitamin $vitamin)
    {
        $vitamin->delete();
        return redirect()->back()->with('destroy', 1);
    }
}
