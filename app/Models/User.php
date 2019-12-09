<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use \Illuminate\Auth\Authenticatable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     *
     */

    protected $fillable = [
        'username',
        'email',
        'password',
        'first_name',
        'last_name',
        'location',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /* Get the username name */

    public function getName()
    {
        if ($this->first_name && $this->last_name) {
            return "{$this->first_name} {$this->last_name}";
        }

        if ($this->first_name) {
            return $this->first_name;
        }

        return null;
    }

    public function getNameOrUsername()
    {
        return $this->getName() ?: $this->username;
    }

    public function getFirstNameOrUsername()
    {
        return $this->first_name ?: $this->username;
    }

    /* Get the avatar url */

    public function getAvatarUrl()
    {
        return "https://www.gravatar.com/avatar/{{ md5($this->email) }}?d=mm&s=60";
    }

    public function statuses()
    {
        return $this->hasMany('App\Models\Status', 'user_id');
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /* Friends of a user */

    public function friendsOfMine()
    {
        return $this->belongsToMany('App\Models\User',
            'friends', 'user_id', 'friend_id');
    }

    public function friendOf()
    {
        return $this->belongsToMany('App\Models\User',
            'friends', 'friend_id', 'user_id');
    }

    public function friends()
    {
        return $this->friendsOfMine()->wherePivot('accepted', true)
            ->get()->merge($this->friendOf()->wherePivot('accepted', true)->get());
    }

    /* Method for friend requests */

    public function friendRequests()
    {
        return $this->friendsOfMine()->wherePivot('accepted', false)->get();
    }

    public function friendRequestsPending()
    {
        return $this->friendOf()->wherePivot('accepted', false)->get();
    }

    public function hasFriendRequestPending(User $user)
    {
        return (bool) $this->friendRequestsPending()->where('id', $user->id)->count();
    }

    public function hasFriendRequestReceived(User $user)
    {
        return (bool) $this->friendRequests()->where('id', $user->id)->count();
    }

    public function addFriend(User $user)
    {
        $this->friendOf()->attach($user->id);
    }

    public function acceptFriendRequest(User $user)
    {
        $this->friendRequests()->where('id', $user->id)->first()->pivot->
            update([
           'accepted' => true,
        ]);
    }

    public function isFriendsWith(User $user)
    {
        return (bool) $this->friends()->where('id', $user->id)->count();
    }
}
