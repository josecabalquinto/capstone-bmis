<?php

namespace App\Http\Controllers;

use App\Models\Children;
use App\Models\GrowthTrack;
use App\Models\HeightForAge;
use App\Models\Purok;
use App\Models\WeightForAge;
use App\Models\WeightForHeight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChildrenController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index()
    {
        $data = array(
            'crs'   =>  Children::all()
        );

        return view('children-records.index', $data);
    }

    public function create()
    {
        return view('children-records.create', ['puroks' => Purok::all()]);
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'purok_id' => 'required',
            'fullname' => 'required|unique:childrens,fullname',
            'caregiver' => 'required',
            'sex' => 'required',
            'age_in_months' => 'required|numeric|min:0|max:71',
            'weight' => 'required',
            'height' => 'required'
        ]);

        // dd($data);
        $purok = Purok::find($request->purok_id);
        $data['purok'] = $purok->purok;

        $child = Children::create($data);

        $gender = $child->sex == 'f' ? 'girl' : 'boy';
        GrowthTrack::create(
            array(
                'child_id' =>   $child->id,
                'age'       =>  $child->age_in_months,
                'weight'    =>  $child->weight,
                'height'    =>  $child->height,
                'wfa'       =>  $this->checkWFA(intval($child->age_in_months), floatval($child->weight), $gender),
                'hfa'       =>  $this->checkHFA(intval($child->age_in_months), floatval($child->height), $gender),
                'wfh'       =>  $this->checkWFH(intval($child->weight), floatval($child->height), $gender),
            )
        );
        return redirect()->back()->with('create', 1);
    }

    public function growth(Children $children, Request $request)
    {
        $children->age_in_months = $request->age;
        $children->weight = $request->weight;
        $children->height = $request->height;
        $children->save();
        $gender = $children->sex == 'f' ? 'girl' : 'boy';
        // dd($gender);
        GrowthTrack::create(
            array(
                'child_id' =>   $children->id,
                'age'       =>  $children->age_in_months,
                'weight'    =>  $children->weight,
                'height'    =>  $children->height,
                'wfa'       =>  $this->checkWFA(intval($children->age_in_months), floatval($children->weight), $gender),
                'hfa'       =>  $this->checkHFA(intval($children->age_in_months), floatval($children->height), $gender),
                'wfh'       =>  $this->checkWFH(intval($children->weight), floatval($children->height), $gender),
            )
        );
        return redirect()->back()->with('create', 1);
    }

    public function checkWFA($age, $weight, $gender)
    {
        $wfa = WeightForAge::where([['age', '=', $age], ['gender', '=', $gender]])->get();
        if ($wfa->count() == 0) return null;
        if ($weight <= $wfa[0]->su) {
            return 'SU';
        } elseif ($weight >= $wfa[0]->u_fr && $weight <= $wfa[0]->u_to) {
            return 'U';
        } elseif ($weight >= $wfa[0]->n_fr && $weight <= $wfa[0]->n_to) {
            return 'N';
        } else {
            return 'O';
        }
    }

    public function checkHFA($age, $height, $gender)
    {
        $hfa = HeightForAge::where([['age', '=', $age], ['gender', '=', $gender]])->get();

        if ($hfa->count() == 0) return null;
        if ($height <= $hfa[0]->ss) {
            return 'SS';
        } elseif ($height >= $hfa[0]->s_fr && $height <= $hfa[0]->s_to) {
            return 'S';
        } elseif ($height >= $hfa[0]->n_fr && $height <= $hfa[0]->n_to) {
            return 'N';
        } else {
            return 'T';
        }
    }

    public function checkWFH($weight, $height, $gender)
    {
        $height = round($height / 0.5) * 0.5;
        $wfh = WeightForHeight::where([['length', '=', $height], ['gender', '=', $gender]])->get();

        if ($wfh->count() == 0) return null;

        if ($weight <= $wfh[0]->sw) {
            return 'SW';
        } elseif ($weight >= $wfh[0]->w_fr && $weight <= $wfh[0]->w_to) {
            return 'W';
        } elseif ($weight >= $wfh[0]->n_fr && $weight <= $wfh[0]->n_to) {
            return 'N';
        } elseif ($weight >= $wfh[0]->ow_fr && $weight <= $wfh[0]->ow_to) {
            return 'OW';
        } else {
            return 'O';
        }
    }

    public function show(Children $children)
    {
        $data = array(
            'child' => $children,
            'gt'    => GrowthTrack::where('child_id', $children->id)->get()
        );

        return view('children-records.show', $data);
    }
}
