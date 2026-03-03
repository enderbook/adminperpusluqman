<?php

namespace App\Filament\Resources\Peminjamen\Schemas;

use Filament\Schemas\Schema;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Utilities\Get;
use Carbon\Carbon;

class PeminjamanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('anggota_id')
                    ->relationship('anggota', 'nama')
                    ->required()
                    ->placeholder('nama anggota...'),
                Select::make('buku_id')
                    ->relationship('buku', 'judul')
                    ->required()
                    ->placeholder('nama buku...'),
                DatePicker::make('tanggal_pinjam')
                    ->required(),
                DatePicker::make('tanggal_kembali')
                    ->required()
                    ->reactive(),

                TextInput::make('nominal_per_hari')
                    ->label('Nominal Denda / Hari')
                    ->numeric()
                    ->default(2000)
                    ->reactive()
                    ->dehydrated(false),

                DatePicker::make('tanggal_dikembalikan')
                    ->reactive()
                    ->afterStateUpdated(function ($set, $get, $state) {

                        $tanggalKembali = $get('tanggal_kembali');
                        $nominal = $get('nominal_per_hari');

                        if (!$state || !$tanggalKembali || !$nominal) {
                            $set('denda', 0);
                            return;
                        }

                        $kembali = Carbon::parse($tanggalKembali);
                        $dikembalikan = Carbon::parse($state);

                        if ($dikembalikan->greaterThan($kembali)) {

                            $lateDays = $kembali->diffInDays($dikembalikan);

                            $set('denda', $lateDays * $nominal);

                        } else {
                            $set('denda', 0);
                        }
                    }),
                 

                TextInput::make('denda')
                    ->numeric()
                    ->default(0)
                    ->required(),

                

            ]);
    }
}
