<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable =['title' , 'slug' , 'description' , 'user_id' ,'image_path'] ; 

    public function user(){
        return $this->belongsTo(User::class);
    }


    public function comments()
{
    return $this->hasMany(Comment::class);
}

protected static function boot()
{
    parent::boot();

    // Delete related comments when a post is deleted
    static::deleting(function ($post) {
        $post->comments()->delete(); // Delete all related comments
    });
}
}
