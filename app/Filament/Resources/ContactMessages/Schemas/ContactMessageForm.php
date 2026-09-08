<?php

namespace App\Filament\Resources\ContactMessages\Schemas;

use App\Enums\ContactMessageStatus;
use App\Enums\ContactMessageType;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactMessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Inbound Message Details')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('email')
                                    ->email()
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('subject')
                                    ->maxLength(255),
                                Select::make('type')
                                    ->options([
                                        ContactMessageType::GENERAL->value => 'General Question',
                                        ContactMessageType::INQUIRY->value => 'Project Inquiry',
                                        ContactMessageType::COLLABORATION->value => 'Collaboration',
                                        ContactMessageType::HIRING->value => 'Hiring / Contract',
                                    ]),
                                Select::make('status')
                                    ->options([
                                        ContactMessageStatus::UNREAD->value => 'Unread',
                                        ContactMessageStatus::READ->value => 'Read',
                                        ContactMessageStatus::REPLIED->value => 'Replied',
                                        ContactMessageStatus::ARCHIVED->value => 'Archived',
                                    ])
                                    ->default(ContactMessageStatus::UNREAD->value)
                                    ->required(),
                            ]),
                        Textarea::make('message')
                            ->required()
                            ->rows(6)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
