<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'bio',
        'email',
        'password',
        'image',
        'private_account'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'password',
        'remember_token',
        'email_verified_at',
        'private_account',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'private_account' => 'boolean'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'following_user_id')
            ->wherePivot('confirmed', '=', true);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_user_id', 'user_id')->where('confirmed', '=', true);
    }

    public function confirmedFollowers()
    {
        return $this->followers()->wherePivot('confirmed', '=', 1);
    }

    public function pendingFollowers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_user_id', 'user_id')->where('confirmed', '=', false);
    }

    public function toggle_follow(User $user)
    {
        if ($user->private_account) {
            return $this->following()->toggle($user);
        }
        $this->following()->toggle($user);
        $this->set_confirmed($user);

    }

    public function is_following(User $user)
    {
        return $this->following()->where('following_user_id', $user->id)->exists();
    }

    public function is_follower(User $user)
    {
        return $this->followers()->where('user_id', $user->id)->exists();
    }

    public function confirm_follow_request(User $user)
    {
        return $this->followers()->updateExistingPivot($user, ['confirmed' => true]);
    }

    public function delete_follow_request(User $user)
    {
        return $this->followers()->detach($user);
    }

    public function set_confirmed(User $user)
    {
        if (!$user->private_account) {
            DB::table('follows')
                ->where('user_id', $this->id)
                ->where('following_user_id', $user->id)
                ->update([
                    'confirmed' => 1
                ]);
        }
        return true;
    }

    
}
