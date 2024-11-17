<?php

namespace App\Http\Controllers\API;

use App\Models\Racer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RacerResource;
use Spatie\QueryBuilder\QueryBuilder;

class RacerController extends Controller
{
    public function index(Request $request)
    {
        $racers = QueryBuilder::for(Racer::class)
            ->allowedFilters('name', 'country', 'price');

        return RacerResource::collection($racers->jsonPaginate());
    }
}
