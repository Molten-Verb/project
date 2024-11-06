<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Spatie\QueryBuilder\QueryBuilder;

class UsersController extends Controller
{
    public function index(): View
    {
        $users = QueryBuilder::for(User::class)
            ->allowedSorts('name', 'email', 'birthday', 'created_at')
            ->paginate(config('users.users_per_page'));

        return view('users.users', compact('users'));
    }

    public function destroy(User $user, Request $request): RedirectResponse
    {
        if (Auth::user()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        $user->delete();

        return redirect()->route('users.index')->with('message', 'Успешно');
    }
}
