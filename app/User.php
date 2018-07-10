<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'hometeam','codingteam', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function memos()
    {
        return $this->hasMany(Memo::class);
    }
    
    public function friends()
    {
        return $this->belongsToMany(User::class, 'user_friend', 'user_id', 'friend_id')->withTimestamps();
    }
    
    public function friend($userId)
    {
        // confirm if already following
        $exist = $this->is_friending($userId);
        // confirming that it is not you
        $its_me = $this->id == $userId;
    
        if ($exist || $its_me) {
            // do nothing if already following
            return false;
        } else {
            // follow if not following
            $this->friends()->attach($userId);
            return true;
        }
    }
    
    public function unfriend($userId)
    {
        // confirming if already following
        $exist = $this->is_friending($userId);
        // confirming that it is not you
        $its_me = $this->id == $userId;
    
    
        if ($exist && !$its_me) {
            // stop following if following
            $this->friends()->detach($userId);
            return true;
        } else {
            // do nothing if not following
            return false;
        }
    }
    
    
    public function is_friending($userId) {
        return $this->friends()->where('friend_id', $userId)->exists();
    }
}
