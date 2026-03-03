<?php

namespace App\Filament\Resources\Bukus\Schemas;

use Filament\Schemas\Schema;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;


class BukuForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
                    ->required()
                    ->label('Judul Buku'),
                TextInput::make('isbn')
                    ->required()
                    ->label('ISBN'),
                TextInput::make('stok')
                    ->required()
                    ->numeric()
                    ->label('Stok Buku'),
                Select::make('kategori_id')
                    ->relationship('kategori', 'nama')
                    ->required()
                    ->placeholder('pilih kategori...'),
                Select::make('penulis_id')
                    ->relationship('penulis', 'nama')
                    ->required()
                    ->placeholder('pilih penulis...')
            ]);
    }
}
