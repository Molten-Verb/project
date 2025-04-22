<?php

namespace App\Http\Controllers;

use App\Http\Services\F1Info;
use Illuminate\Http\Request;
use Illuminate\View\View;

class F1ApiController extends Controller
{
    public function index(): View
    {
        $drivers = F1Info::getDrivers();
        $jsonDecodedDrivers = json_decode($drivers, true);

        return view('realRacers', compact('jsonDecodedDrivers'));
    }
}
