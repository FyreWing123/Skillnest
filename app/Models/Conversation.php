<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = ['user1_id', 'user2_id', 'last_message_at'];

    protected $casts = ['last_message_at' => 'datetime'];

    public function user1() { return $this->belongsTo(User::class, 'user1_id'); }
    public function user2() { return $this->belongsTo(User::class, 'user2_id'); }
    public function messages() { return $this->hasMany(Message::class); }
    public function lastMessage() { return $this->hasOne(Message::class)->latestOfMany(); }

    /** The other participant in the conversation */
    public function otherUser(int $myId): User
    {
        return $this->user1_id === $myId ? $this->user2 : $this->user1;
    }

    /** Count of unread messages sent by the other user */
    public function unreadCount(int $myId): int
    {
        return $this->messages()
            ->where('sender_id', '!=', $myId)
            ->whereNull('read_at')
            ->count();
    }
}
