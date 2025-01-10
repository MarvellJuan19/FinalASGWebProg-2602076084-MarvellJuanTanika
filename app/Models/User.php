<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi untuk mendapatkan semua wishlist pengguna
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    // Relasi untuk mendapatkan pengguna yang dimasukkan ke wishlist pengguna ini
    public function targetUsersInWishlist()
    {
        return $this->hasMany(Wishlist::class, 'target_user_id');
    }

    public function followers()
    {
        return $this->hasMany(Following::class, 'followed_id');
    }

    public function followings()
    {
        return $this->hasMany(Following::class, 'follower_id');
    }

    public function senderChats()
    {
        return $this->hasMany(Chat::class, 'sender_id');
    }

    public function receiverChats()
    {
        return $this->hasMany(Chat::class, 'receiver_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
