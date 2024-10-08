<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class SaveImage
{
    protected ?UploadedFile $image;
    protected ?string $url;
    protected ?string $nameFolder;

    public function saveImage($image, string $nameFolder = null):void
    {
        $imageOriginalName = $image->getClientOriginalName();

        if (!isset($nameFolder))
        {
            $currentRouteName = Route::currentRouteName();
            $explodeRouteName = explode('.', $routeName);
            $nameFolder = $explodeRouteName[1];
        }

        $path = $image->storeAs(
            "public/{$nameFolder}", $imageOriginalName
        );

        $this->url = Storage::url($path);
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
