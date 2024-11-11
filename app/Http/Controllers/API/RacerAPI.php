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
        $perPage = $request->get('per_page', 10);

        $racers = QueryBuilder::for(Racer::class)
            ->allowedFilters('name', 'country', 'price')
            ->paginate($perPage);

            // например http://127.0.0.1:8000/api?filters[racers]=имя&фамилия

        return response()->json(RacerResource::collection($racers), 200, [], JSON_UNESCAPED_UNICODE);
    }
}
