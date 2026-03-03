<?php

namespace App\Filament\Resources\Penulis\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

class PenulisForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->required()
                    ->label('Nama Penulis')
                    ->placeholder('Masukkan nama lengkap penulis...'),
                Textarea::make('bio')
                    ->required()
                    ->label('Biodata Penulis')
            ]);
    }
}
