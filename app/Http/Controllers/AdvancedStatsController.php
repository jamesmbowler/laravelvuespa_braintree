<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function basic() {
        return response()->json(['basic'=>true]);
    }
}
