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
        //likingの状態
        $exist_f = $this->is_friending($userId);
        //zuttomoingの状態
        $exist_z = $this->is_zuttomoing($userId);
        // confirming that it is not you
        $its_me = $this->id == $userId;
    
        if($exist_f || $its_me) {
            // likeが押されている時do nothing
            return false;
        } elseif($exist_z) {
            //zuttomoを押しているとき、zuttomoを消してlikeを入れる
            $this->zuttomoings()->detach($userId);
            $this->friends()->attach($userId);
            return true;
        } elseif($exist_f && $exist_z) {
            // zuttomoとlike両方押されているとき（ありえない）do nothing
            return false;
        } else {
            // 何も押されていないときdo "like"
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

    // zuttomo
    public function zuttomoings()
    {
        return $this->belongsToMany(User::class, 'user_zuttomo', 'user_id', 'zuttomo_id')->withTimestamps();
    }
    
    public function zuttomo($userId)
    {
        // likingの状態
        $exist_f = $this->is_friending($userId);
        //zuttomoの状態
        $exist_z = $this->is_zuttomoing($userId);
        // confirming that it is not you
        $its_me = $this->id == $userId;
        
        if($exist_z || $its_me) {
            // do nothing
            return false;
        } elseif($exist_f) {
            $this->friends()->detach($userId);
            $this->zuttomoings()->attach($userId);
            return true;
        } elseif($exist_f && $exist_z) {
            // do nothing
            return false;
        } else {
            // do "want"
            $this->zuttomoings()->attach($userId);
            return true;
        }
    }
    
    public function unzuttomo($userId)
    {
        // confirming if already zuttomoing
        $exist = $this->is_zuttomoing($userId);
        // confirming that it is not you
        $its_me = $this->id == $userId;
    
    
        if ($exist && !$its_me) {
            // stop zuttomoing if zuttomoing
            $this->zuttomoings()->detach($userId);
            return true;
        } else {
            // do nothing if not zuttomoing
            return false;
        }
    }
    
    
    public function is_zuttomoing($userId) {
        return $this->zuttomoings()->where('zuttomo_id', $userId)->exists();
    }
    
}