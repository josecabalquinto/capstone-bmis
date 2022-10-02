<?php

namespace App\Http\Controllers;

use App\Models\HeightForAge;
use App\Models\WeightForAge;
use Illuminate\Http\Request;

class HeightForAgeController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function boys()
    {
        $data = array(
            'hfaboys' => HeightForAge::where('gender', 'boy')->orderBy('age', 'desc')->get()

        );
        return view('height-for-age.boys', $data);
    }

    public function girls()
    {
        $data = array(
            'hfagirls' => HeightForAge::where('gender', 'girl')->orderBy('age', 'desc')->get()

        );

        return view('height-for-age.girls', $data);
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'age' => 'required',
            'ss' => 'required',
            's_fr' => 'required',
            's_to' => 'required',
            'n_fr' => 'required',
            'n_to' => 'required',
            'tall' => 'required',
            'gender' => 'required',
        ]);

        $data['gender'] = strtolower($data['gender']);

        HeightForAge::create($data);
        return redirect()->back()->with('create', 1);
    }

    public function destroy(HeightForAge $heightForAge)
    {
        $heightForAge->delete();
        return redirect()->back();
    }
}
