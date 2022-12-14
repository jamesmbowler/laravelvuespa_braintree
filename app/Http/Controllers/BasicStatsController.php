<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BasicStatsController extends Controller
{
    public function stats() {
        return response()->json(['basic'=>true]);
    }
}
