<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user1()
    {
        return $this->belongsTo(User::class, 'user_1_id');
    }

    public function user2()
    {
        return $this->belongsTo(User::class, 'user_2_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'chats', 'id', 'id')
            ->withPivot('user_1_id', 'user_2_id');
    }

    public function messages()
    {
        return $this->hasMany(ChatMessage::class);
    }
}
