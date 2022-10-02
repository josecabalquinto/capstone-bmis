<?php

namespace App\Http\Controllers;

use App\Models\WeightForAge;
use Illuminate\Http\Request;

class WeightForAgeController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function boys()
    {
        $data = array(
            'wfaboys' => WeightForAge::where('gender', 'boy')->orderBy('age', 'desc')->get()

        );
        return view('weight-for-age.boys', $data);
    }

    public function girls()
    {
        $data = array(
            'wfagirls' => WeightForAge::where('gender', 'girl')->orderBy('age', 'desc')->get()

        );
        return view('weight-for-age.girls', $data);
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'age' => 'required',
            'su' => 'required',
            'u_fr' => 'required',
            'u_to' => 'required',
            'n_fr' => 'required',
            'n_to' => 'required',
            'o' => 'required',
            'gender' => 'required',
        ]);

        $data['gender'] = strtolower($data['gender']);

        WeightForAge::create($data);
        return redirect()->back()->with('create', 1);
    }

    public function destroy(WeightForAge $weightForAge)
    {
        $weightForAge->delete();
        return redirect()->back();
    }
}
