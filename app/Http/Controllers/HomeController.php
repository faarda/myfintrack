<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        $this->updateLastMonth();

        $user_spendings = $user->spending_this_month;
        $earning_this_month = $user->income_this_month;
        $available_balance = $earning_this_month - $user_spendings;
        $available_balance = $available_balance > 0 ? $available_balance : 0;
        $spending_increase = $user->spending_last_month == 0 ? 0 : (($user_spendings - $user->spending_last_month)/$user->spending_last_month) * 100;

        $percentage_spent = $earning_this_month == 0 ? 0 : ($user_spendings/$earning_this_month)*100;

        if($user_spendings > $earning_this_month){
            $spending_summary = [
                'text' => 'You appear to be in debt!',
                'icon' => 'anchor',
                'class' => 'bad'
            ];
        } else if($percentage_spent == 0){
            $spending_summary = [
                'text' => 'Sorry! We can\'t make that judgement yet',
                'icon' => 'frown',
                'class' => ''
            ];
        }else if($percentage_spent <= 50){
            $spending_summary = [
                'text' => 'Keep it up! you\'ve been spending wisely',
                'icon' => 'check-circle',
                'class' => 'good'
            ];
        }else{
            $spending_summary = [
                'text' => 'You need to cut your spendings',
                'icon' => 'alert-triange',
                'class' => 'bad'
            ];
        }

        $spendings_count = $user->spendings()->count();
        $spending_history = $user->spendings()->orderBy('id', 'desc')->take(10)->get();

        $data = [
            'ab' => $available_balance,
            'stm' => $user_spendings,
            'etm' => $earning_this_month,
            'si' => $spending_increase,
            'ss' => $spending_summary,
            'sh' => $spending_history,
            'sc' => $spendings_count
        ];
        
        return view('home.dashboard')->with('data', $data);
    }

    public function updateLastMonth()
    {
        $user = Auth::user();

        if($user->spending_last_month == 0){

            $last_month = (int)date('m') - 1;

            $spendings_last_month = $user->spendings()->whereMonth('created_at', $last_month)->sum('amount');

            if($spendings_last_month > 0){
                $user->update(['spending_last_month' => $spendings_last_month]);
            }

        }else {
            return;
        }

    }
}
