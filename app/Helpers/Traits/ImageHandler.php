<?php

namespace App\Helpers\Traits;

use Illuminate\Support\Facades\Storage;

trait ImageHandler 
{
    public static function uploadImage($cover)
    {
        $coverName = $cover->hashName();
        $cover->storeAs(self::$imagePath, $coverName);

        return $coverName;
    }

    public static function updateImage($cover, $oldCoverName)
    {
        $newCover = self::uploadImage($cover);
        self::deleteImage($oldCoverName);

        return $newCover;
    }

    public static function deleteImage($image)
    {
        if ($image) {
            Storage::delete(self::$imagePath.'/'.$image);
        }
    }
}