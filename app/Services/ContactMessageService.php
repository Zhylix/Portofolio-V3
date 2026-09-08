<?php

namespace App\Services;

use App\Enums\ContactMessageStatus;
use App\Models\ContactMessage;

class ContactMessageService
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function store(array $data): ContactMessage
    {
        return ContactMessage::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'subject' => $data['subject'] ?? null,
            'message' => $data['message'],
            'type' => $data['type'] ?? null,
            'status' => ContactMessageStatus::UNREAD,
        ]);
    }
}
