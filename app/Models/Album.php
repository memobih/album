<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Album extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
    ];
    protected static function boot()
    {
        parent::boot();
        static::creating(function($model){
            $model->user_id=auth()->user()->id;
        });
    }
   public function pictures(){ 
    return $this->hasMany(Picture::class ,'album_id','id');
   }
   public function user(){
    return $this->belongsTo(User::class ,'user_id' , 'id');
   }
}
