<?php

namespace Tests\Feature;

use App\Enums\ContactMessageStatus;
use App\Enums\ContactMessageType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactMessageTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_submit_contact_message(): void
    {
        $payload = [
            'name' => 'John Developer',
            'email' => 'john@example.com',
            'type' => ContactMessageType::INQUIRY->value,
            'subject' => 'System Architecture Consulting Request',
            'message' => 'Hello Helmy, I would like to discuss an enterprise backend architecture project with you.',
        ];

        $response = $this->post('/contact', $payload);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('contact_messages', [
            'email' => 'john@example.com',
            'subject' => 'System Architecture Consulting Request',
            'status' => ContactMessageStatus::UNREAD->value,
        ]);
    }

    public function test_contact_form_validates_required_fields(): void
    {
        $response = $this->post('/contact', []);

        $response->assertSessionHasErrors(['name', 'email', 'message']);
    }
}
