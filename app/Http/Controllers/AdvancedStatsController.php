<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdvancedStatsController extends Controller
{
    public function stats(Request $request) {
        if (!$request->user()->activeSubscription) {
            return response()->json(['advanced'=>false]);
        }
        
        return response()->json(['advanced'=>true]);

    }
}
