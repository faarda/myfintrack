<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Earning;

class EarningController extends Controller
{
    public function __construsct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $earnings_count = $user->earnings()->count();
        $earning_history = $user->earnings()->orderBy('id', 'desc')->take(10)->get();

        $data = [
            'eh' => $earning_history,
            'ec' => $earnings_count
        ];

        return view('home.earnings')->with('data', $data);    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request, [
            'description' => 'required|string|max:1000',
            'amount' => 'required|numeric'
        ]);

        $user = Auth::user();

        $earning = $user->earnings()->create(['description' => $request->description, 'amount' => (float)$request->amount]);

        $user->increment('income_this_month', (float)$request->amount);

        return response()->json([
            'status' => 'saved',
            'id' => $earning->id
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();

        $earnings = $user->earnings()->orderBy('id', 'desc')->skip(($id - 1) * 10)->take(10)->get();

        return response()->json($earnings, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'description' => 'required|string|max:1000',
            'amount' => 'required|numeric'
        ]);

        $user = Auth::user();

        $earning = Earning::find($id);

        $old_amount = $earning->amount;

        $earning->update(['description' => $request->description, 'amount' => $request->amount]);

        $user->increment('income_this_month', (float)$request->amount - $old_amount);

        return response()->json([
            'status' => 'saved',
            'id' => $earning->id
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();

        $earning = Earning::find($id);

        $old_amount = $earning->amount;

        $earning->delete();

        $user->decrement('income_this_month', (float)$old_amount);

        return response()->json([
            'status' => 'deleted',
            'id' => $earning->id
        ],200);
    }
}
