<?php

namespace App\Http\Controllers;

use App\Models\Children;
use App\Models\DistributionDetails;
use App\Models\Food;
use App\Models\Purok;
use App\Models\Vitamin;
use App\Models\VitaminDistribution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VitaminDistributionController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index()
    {
        $data = array(
            'vds'   => DB::table('vitamin_distributions')
                ->join('puroks', 'vitamin_distributions.purok_id', '=', 'puroks.id')
                ->join('vitamins', 'vitamin_distributions.vitamin_id', '=', 'vitamins.id')
                ->select('vitamin_distributions.*', 'puroks.purok', 'vitamins.vitamin')
                ->get()
        );

        return view('vitamin-distributions.index', $data);
    }

    public function show(VitaminDistribution $vitaminDistribution)
    {
        $vd = DB::table('vitamin_distributions')
            ->join('puroks', 'vitamin_distributions.purok_id', '=', 'puroks.id')
            ->join('vitamins', 'vitamin_distributions.vitamin_id', '=', 'vitamins.id')
            ->where('vitamin_distributions.id', $vitaminDistribution->id)
            ->select('vitamin_distributions.*', 'puroks.purok', 'vitamins.vitamin')
            ->get();
        $data = array(
            'vd'   => $vd[0],
            'beneficiaries' =>  DB::table('distribution_details')
                ->join('childrens', 'distribution_details.child_id', '=', 'childrens.id')
                ->where('distribution_details.distribution_id', $vitaminDistribution->id)
                ->where('distribution_details.type', 'v')
                ->select('childrens.fullname')
                ->get()
        );
        // dd($data);
        return view('vitamin-distributions.show', $data);
    }

    public function create()
    {
        $data = array(
            'puroks'    =>  Purok::all(),
            'vitamins'     =>  Vitamin::all(),
        );

        return view('vitamin-distributions.create', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'distributor' => 'required|string',
            'purok_id'      => 'required',
            'vitamin_id'       =>  'required'
        ]);

        $vd = VitaminDistribution::create($request->all());
        $children = Children::where('purok_id', $request->purok_id)->get();

        foreach ($children as $child) {
            $data = array(
                'distribution_id'  =>  $vd->id,
                'child_id'  =>  $child->id,
                'type'  => 'v'
            );

            DistributionDetails::create($data);
        }
        return redirect()->back()->with('create', 1);
    }
}
