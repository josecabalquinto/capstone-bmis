<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index()
    {
        $data = array(
            'foods' =>  Food::all()
        );

        return view('foods.index', $data);
    }

    public function foods()
    {
        $data = array(
            'foods' => Food::all()
        );

        return view('foods.index', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'food' => 'required|string|unique:foods,food',
            'description' => 'required|string'
        ]);

        $data = array(
            'food' =>  strtolower($request->food),
            'description' =>  strtolower($request->description),
            'added_by' => Auth::user()->name
        );
        Food::create($data);
        return redirect()->back()->with('create', 1);
    }

    public function destroy(Food $food)
    {
        $food->delete();
        return redirect()->back()->with('destroy', 1);
    }
}
