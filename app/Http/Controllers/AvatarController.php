<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Controllers\Controller;

class AvatarController extends Controller
{
    public function index()
    {
        return view('profile.avatar');
    }

    public function save(Request $request)
    {
        $validatedData = $request->validate([
         'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',

        ]);
        

        $name = $request->file('image')->getClientOriginalName();
        dump($validatedData);
        $path = $request->file('image')->storeAs(
            'avatars', $request->user()->id
        );
        dd($path);
        //$path = $request->file('image')->store('public/images');
    
        $path = $request->file('avatar')->store('avatars');
        $save = new Photo;

        $save->name = $name;
        $save->path = $path;

        $save->save();

        return Redirect::route('profile.edit');

    }
}
