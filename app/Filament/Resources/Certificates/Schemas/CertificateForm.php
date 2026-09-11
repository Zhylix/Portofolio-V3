<?php

namespace App\Filament\Resources\Certificates\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CertificateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Certificate Details')
                    ->description('Upload dan manage certificate yang sudah kamu dapatkan.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title')
                                    ->label('Title')
                                    ->required()
                                    ->helperText('Nama resmi sertifikat atau sertifikasi kompetensi.')
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                                TextInput::make('slug')
                                    ->label('Slug')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->helperText('Slug unik untuk URL sertifikat.'),
                                TextInput::make('issuer')
                                    ->label('Issuer / Organization')
                                    ->required()
                                    ->helperText('Lembaga atau vendor penerbit (misal: AWS, Dicoding, Google).'),
                                TextInput::make('credential_id')
                                    ->label('Credential ID / License No.')
                                    ->helperText('Nomor lisensi atau ID sertifikat untuk verifikasi.'),
                                DatePicker::make('issued_at')
                                    ->label('Issued Date'),
                                DatePicker::make('expires_at')
                                    ->label('Expires Date'),
                                TextInput::make('credential_url')
                                    ->label('Credential Verification URL')
                                    ->url()
                                    ->columnSpanFull()
                                    ->helperText('Link verifikasi online sertifikat.'),
                                Toggle::make('featured')
                                    ->label('Featured')
                                    ->helperText('Tampilkan sertifikat ini di highlight portfolio.')
                                    ->default(false),
                                TextInput::make('sort_order')
                                    ->label('Sort Order')
                                    ->numeric()
                                    ->default(0)
                                    ->helperText('Urutan prioritas penampilan.'),
                            ]),
                        Textarea::make('description')
                            ->label('Description')
                            ->rows(3)
                            ->helperText('Deskripsi singkat materi atau keahlian yang diujikan.'),
                    ]),

                Section::make('Skills & Verification Document')
                    ->description('Hubungkan dengan skills dan upload dokumen sertifikat.')
                    ->schema([
                        Select::make('skills')
                            ->label('Skills')
                            ->relationship('skills', 'name')
                            ->multiple()
                            ->searchable()
                            ->preload()
                            ->helperText('Pilih skills yang dibuktikan oleh sertifikat ini.'),
                        Select::make('experiences')
                            ->label('Related Experiences')
                            ->relationship('experiences', 'title')
                            ->multiple()
                            ->searchable()
                            ->preload(),
                        SpatieMediaLibraryFileUpload::make('image')
                            ->label('Certificate File / Badge')
                            ->collection('image')
                            ->image()
                            ->maxSize(10240)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'application/pdf'])
                            ->helperText('Upload scan sertifikat atau badge bukti resmi.'),
                    ]),
            ]);
    }
}
