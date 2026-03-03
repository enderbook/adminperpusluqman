<?php

namespace App\Filament\Resources\Kategoris\Schemas;

use Filament\Schemas\Schema;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

class KategoriForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->required()
                    ->label('Nama Kategori'),
                Textarea::make('deskripsi')
                    ->required()
                    ->label('Deskripsi')
            ]);
    }
}
