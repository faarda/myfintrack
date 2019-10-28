<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Spending;

class SpendingsController extends Controller
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

        $spendings_count = $user->spendings()->count();
        $spending_history = $user->spendings()->orderBy('id', 'desc')->take(10)->get();

        $data = [
            'sh' => $spending_history,
            'sc' => $spendings_count
        ];
        return view('home.spendings')->with('data', $data);
    }

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

        $spending = $user->spendings()->create(['description' => $request->description, 'amount' => (float)$request->amount]);

        $user->increment('spending_this_month', (float)$request->amount);

        return response()->json([
            'status' => 'saved',
            'id' => $spending->id
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

        $spendings = $user->spendings()->orderBy('id', 'desc')->skip(($id - 1) * 10)->take(10)->get();

        return response()->json($spendings, 200);
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

        $spending = Spending::find($id);

        $old_amount = $spending->amount;

        $spending->update(['description' => $request->description, 'amount' => $request->amount]);

        $user->increment('spending_this_month', (float)$request->amount - $old_amount);

        return response()->json([
            'status' => 'saved',
            'id' => $spending->id
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

        $spending = Spending::find($id);

        $old_amount = $spending->amount;

        $spending->delete();

        $user->decrement('spending_this_month', (float)$old_amount);

        return response()->json([
            'status' => 'deleted',
            'id' => $spending->id
        ],200);

    }
}
