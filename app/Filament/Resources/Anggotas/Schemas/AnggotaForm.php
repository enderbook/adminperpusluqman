<?php

namespace App\Filament\Resources\Anggotas\Schemas;

use Filament\Schemas\Schema;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

class AnggotaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->required()
                    ->label('Nama Anggota'),
                TextInput::make('email')
                    ->required()
                    ->email()
                    ->label('Email Anggota'),
                TextInput::make('no_hp')
                    ->required()
                    ->numeric()
                    ->label('No. HP'),
                Textarea::make('alamat')
                    ->required()
                    ->label('Alamat')
            ]);
    }
}
