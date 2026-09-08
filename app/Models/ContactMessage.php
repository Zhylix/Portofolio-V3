<?php

namespace App\Models;

use App\Enums\ContactMessageStatus;
use App\Enums\ContactMessageType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'type',
        'status',
        'read_at',
    ];

    protected function casts(): array
    {
        return [
            'type' => ContactMessageType::class,
            'status' => ContactMessageStatus::class,
            'read_at' => 'datetime',
        ];
    }

    public function scopeUnread(Builder $query): Builder
    {
        return $query->where('status', ContactMessageStatus::UNREAD->value);
    }

    public function scopeLatestFirst(Builder $query): Builder
    {
        return $query->orderByDesc('created_at');
    }
}
