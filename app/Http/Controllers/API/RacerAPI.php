<?php

namespace App\Http\Controllers\API;

use App\Models\Racer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;

class RacerAPI extends Controller
{
    public function index(Request $request)
    {
        $racers = QueryBuilder::for(Racer::class)
            ->allowedFields('name', 'country', 'price')
            ->allowedFilters('name', 'country', 'price')
            ->jsonPaginate(config('json-api-paginate.default_size'));

            // например http://127.0.0.1:8000/api?fields[racers]=name

        return response()->json($racers, 200, [], JSON_UNESCAPED_UNICODE);
    }
}
