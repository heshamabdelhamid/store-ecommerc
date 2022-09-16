<?php

namespace App\Traits;


trait SaveImageTrait
{
    function saveImage($photo, $path)
    {
        //save photo in folder
        $file_extension = $photo->getClientOriginalExtension();
        $file_name = time() . '.' . $file_extension;
        $photo->move($path, $file_name);
        return $file_name;
    }
}
