<?php
namespace App\Models\Traits;
use Illuminate\Support\Facades\Storage;

trait UploadFiles
{
    public static function UploadPhoto($model)
    {
        if (request()->hasFile('image')) {
          static::DeletePhoto($model);
         $model->image = request()->file('image')->store('image');
        }
    }

    public static function DeletePhoto($model)
    {
        if (!empty($model->image) && Storage::exists($model->image)) {
            Storage::delete($model->image);
        }
    }
}