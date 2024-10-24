<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    use HasFactory;

    public function scopeOrderByPinned($query){
         $query->orderBy('pinned_at', 'desc');
    }

    public function scopeOrderByLastPost($query)
    {
        $query->orderBy(
            Post::select('created_at')
                ->whereColumn('posts.discussion_id', 'discussions.id')
                ->latest()
                ->take(1),
            'desc'
        );
    }

    public function isPinned(){
        return !is_null($this->pinned_at);
    }

    public function topic(){
        return $this->belongsTo(Topic::class);
    }


    public function posts() {
        return $this->hasMany(Post::class);
    }
    
    public function replies()
    {
        return $this->hasMany(Post::class)
            ->whereNotNull('parent_id');
    }

    public function post() {
        return $this->hasOne(Post::class)->whereNull('parent_id');
    }

    public function latestPost(){
        return $this->hasOne(Post::class)->latestOfMany();
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function participants(){
        return $this->hasManyThrough(User::class, Post::class,'discussion_id','id','id','user_id')->distinct();
    }
}
