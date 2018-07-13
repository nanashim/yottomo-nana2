<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_friend extends Model
{
    protected $table = 'user_friend';
    
    // public function futures()
    // {
    // return $this->hasMany(User::class);
    // }
    
    
    // public function futures()
    // {
    //     $futures = User::where('id','>=', 817)->get();
    //     return $futures;
    //     // return $this->where('friend_id','<=', 850);
        
    //     // return $this->belongsToMany(User::class, 'user_friend', 'user_id', 'friend_id')->withTimestamps();
    // }
}
