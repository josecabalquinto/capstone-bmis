<?php

namespace App\Http\Controllers;

use App\Models\Children;
use App\Models\DistributionDetails;
use App\Models\Food;
use App\Models\FoodDistribution;
use App\Models\Purok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FoodDistributionController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index()
    {
        $data = array(
            'fds'   => DB::table('food_distributions')
                ->join('puroks', 'food_distributions.purok_id', '=', 'puroks.id')
                ->join('foods', 'food_distributions.food_id', '=', 'foods.id')
                ->select('food_distributions.*', 'puroks.purok', 'foods.food')
                ->get()
        );

        return view('food-distributions.index', $data);
    }

    public function filter(Request $request)
    {
        $from = date($request->from);
        $to = date($request->to);

        $data = array(
            'fds'   => DB::table('food_distributions')
                ->join('puroks', 'food_distributions.purok_id', '=', 'puroks.id')
                ->join('foods', 'food_distributions.food_id', '=', 'foods.id')
                ->whereBetween('food_distributions.created_at', [$from, $to])
                ->select('food_distributions.*', 'puroks.purok', 'foods.food')
                ->get()
        );


        return view('food-distributions.index', $data);
    }

    public function show(FoodDistribution $foodDistribution)
    {
        $fd = DB::table('food_distributions')
            ->join('puroks', 'food_distributions.purok_id', '=', 'puroks.id')
            ->join('foods', 'food_distributions.food_id', '=', 'foods.id')
            ->where('food_distributions.id', $foodDistribution->id)
            ->select('food_distributions.*', 'puroks.purok', 'foods.food')
            ->get();
        $data = array(
            'fd'    =>  $fd[0],
            'beneficiaries' =>  DB::table('distribution_details')
                ->join('childrens', 'distribution_details.child_id', '=', 'childrens.id')
                ->where('distribution_details.distribution_id', $foodDistribution->id)
                ->where('distribution_details.type', 'f')
                ->select('childrens.fullname')
                ->get()
        );
        return view('food-distributions.show', $data);
    }

    public function create()
    {
        $data = array(
            'puroks'    =>  Purok::all(),
            'foods'     =>  Food::all(),
        );

        return view('food-distributions.create', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'distributor' => 'required|string',
            'purok_id'      => 'required',
            'food_id'       =>  'required'
        ]);

        $food_qty = Food::find($request->food_id);


        if ($food_qty->quantity < $request->quantity) {
            return redirect()->back()->with('qty_er', 1);
        } else {
            $food_qty->quantity = $food_qty->quantity - $request->quantity;
            $food_qty->save();
        }

        $fd = FoodDistribution::create($request->all());

        $children = Children::where('purok_id', $request->purok_id)->get();

        foreach ($children as $child) {
            $data = array(
                'distribution_id'  =>  $fd->id,
                'child_id'  =>  $child->id,
                'type'  => 'f'
            );

            DistributionDetails::create($data);
        }
        return redirect()->back()->with('create', 1);
    }

    public function deductQty($qty, $food_id)
    {
        return Food::where('id', $food_id)->update([
            'quantity' => $qty
        ]);
    }

    public function destroy(FoodDistribution $foodDistribution)
    {
        $foodDistribution->delete();
        return redirect()->back()->with('destroy', 1);
    }
}
