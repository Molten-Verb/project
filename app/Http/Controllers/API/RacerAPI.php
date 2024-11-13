<?php

namespace App\Http\Controllers\API;

use App\Models\Racer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RacerResource;
use Spatie\QueryBuilder\QueryBuilder;

class RacerAPI extends Controller
{
    public function index(Request $request)
    {
        $racers = QueryBuilder::for(Racer::class)
            ->allowedFilters('name', 'country', 'price');
            // например http://127.0.0.1:8000/api?filters[price]=1000000

        return RacerResource::collection($racers->jsonPaginate());
    }
}
