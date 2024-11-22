<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = QueryBuilder::for(User::class)
            ->where('email', '!=', 'admin@mail.com')
            ->allowedFilters('id', 'name', 'email', 'birthday');

        return UserResource::collection($users->jsonPaginate());
    }
}
