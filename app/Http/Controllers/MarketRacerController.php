<?php

namespace App\Http\Controllers;

use App\Models\Racer;
use Illuminate\View\View;
use Illuminate\Http\Request;

class MarketRacerController extends Controller
{
    public function index(): View
    {
        $racersList = Racer::get();

        return view('market', compact('racersList'));
    }
}
