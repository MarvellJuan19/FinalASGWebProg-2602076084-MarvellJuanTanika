<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoinController extends Controller
{
    public function topupCoins(Request $request)
    {
        $user = auth()->user();
        $user->coin_balance += 100;
        $user->save();

        return back()->with('success', 'You have successfully topped up 100 coins!');
    }
}