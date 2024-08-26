<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class SaveImage
{
    protected ?UploadedFile $image;
    protected ?string $url;

    public function saveNewImage($image):void
    {
        $imageOriginalName = $image->getClientOriginalName(); // оригинальное имя файла

        $routeName = Route::currentRouteName();
        $explodeRouteName = explode('.', $routeName);
        $nameFolder = $explodeRouteName[1];

        $path = $image->storeAs( // сохр. с оригинальным именем
            "public/{$nameFolder}", $imageOriginalName
        );

        $this->url = Storage::url($path);
    }

    public function getUrl()
    {
        return $this->url;
    }
}
