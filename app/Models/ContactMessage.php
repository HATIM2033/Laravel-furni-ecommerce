<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'subject',
        'message',
        'is_replied',
        'replied_at',
        'admin_reply',
    ];

    protected $casts = [
        'is_replied' => 'boolean',
        'replied_at' => 'datetime',
    ];

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function markAsReplied($reply = null)
    {
        $this->is_replied = true;
        $this->replied_at = now();
        if ($reply) {
            $this->admin_reply = $reply;
        }
        $this->save();
    }
}
