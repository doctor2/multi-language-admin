<?php

namespace App\UseCases;

use App\AdditionalSetting;
use Illuminate\Support\Facades\Storage;
use Image;


class ImageService
{
    public static function resizeImage($file, $path, $name)
    {
        $setting = app()->make(SettingService::class)->getResizeSetting();

        $width = $setting[$name . 'Width'] ?? null;
        $height = $setting[$name . 'Height'] ?? null;

        if (empty($width) || empty($height)) {
            return $file->store($path, 'public');
        }

        $img = Image::make($file);
        $mime = $img->mime();
        $img->height() > $img->width() ? $width=null : $height=null;

        $img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });

        $ext = 'jpg';
        if(strpos($mime, 'png') !== false)
        {
            $ext = 'png';
        }
        elseif (strpos($mime, 'jpeg') === false)
        {
            $img->encode($ext);
        }

        // calculate md5 hash of encoded image
        $hash = md5($img->__toString() . strval(time()));

        // use hash as a name
        $path = "{$path}/{$hash}.{$ext}";

        Storage::disk('public')->put($path, $img->stream());

        return $path;
    }
}
