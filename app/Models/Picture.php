<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UploadFiles;
use Illuminate\Database\Eloquent\SoftDeletes;

class Picture extends Model
{
    use HasFactory  ,SoftDeletes  ,UploadFiles;
    protected $fillable = [
        'name',
        'album_id',
        'url',
    ];
    protected static function boot()
    {
        parent::boot();
        static::created(function ($model) {
            static::UploadPhoto($model);
            $model->save();
        });
        static::forceDeleted(function($model){
            static::DeletePhoto($model);
        });
        static::saving(function ($model) {
            static::UploadPhoto($model);
        });
    }
    public function album(){ 
        return $this->belongsTo(Album::class ,'album_id' ,'id');
    }
    
}
