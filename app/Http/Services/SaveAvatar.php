<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SaveAvatar
{
    public $avatar;
    public $url;

    public function saveNewAvatar($avatar)
    {
        //$avatar = $request->file('image');

        $avatarOriginalName = $avatar->getClientOriginalName(); // оригинальное имя файла
        // расширение файла
        // имя файла с расширением
        //$saveAvatar = Storage::disk('local')->put("public/avatars/{$fileName}" , $avatar);
        $path = $avatar->storeAs( // сохр. с оригинальным именем
            'public/avatars', $avatarOriginalName
        );

        $this->url = Storage::url($path);
    }
}
