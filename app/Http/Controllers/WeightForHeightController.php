<?php

namespace App\Http\Controllers;

use App\Models\WeightForHeight;
use Illuminate\Http\Request;

class WeightForHeightController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function boys()
    {

        $data = array(
            'wfhboys' => WeightForHeight::where('gender', 'boy')->orderBy('length', 'desc')->get()

        );
        return view('weight-for-height.boys', $data);
    }

    public function girls()
    {

        $data = array(
            'wfhboys' => WeightForHeight::where('gender', 'girl')->orderBy('length', 'desc')->get()

        );
        return view('weight-for-height.girls', $data);
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'length' => 'required',
            'sw' => 'required',
            'w_fr' => 'required',
            'w_to' => 'required',
            'n_fr' => 'required',
            'n_to' => 'required',
            'ow_fr' => 'required',
            'ow_to' => 'required',
            'o' => 'required',
            'gender' => 'required',
        ]);

        $data['gender'] = strtolower($data['gender']);

        WeightForHeight::create($data);
        return redirect()->back()->with('create', 1);
    }

    public function destroy(WeightForHeight $weightForHeight)
    {
        $weightForHeight->delete();
        return redirect()->back();
    }
}
