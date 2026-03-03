<?php

namespace App\Filament\Resources\Peminjamen\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Table;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;


class PeminjamenTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no')
                    ->label('No')
                    ->rowIndex(),
                TextColumn::make('anggota.nama'),
                TextColumn::make('buku.judul'),
                TextColumn::make('buku.isbn')
                    ->label('ISBN'),
                TextColumn::make('tanggal_pinjam'),
                TextColumn::make('tanggal_kembali'),
                TextColumn::make('tanggal_dikembalikan'),
                TextColumn::make('denda'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'kembali' => 'success',
                        'lewat' => 'danger',
                        'pinjam' => 'warning',
                    })
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'kembali' => 'Kembali',
                        'lewat' => 'Lewat',
                        'pinjam' => 'Pinjam',
                    ])
                    ->query(function (Builder $query, array $data) {

                        if (! $data['value']) {
                            return $query;
                        }

                        return match ($data['value']) {

                            'kembali' =>
                                $query->whereNotNull('tanggal_dikembalikan'),

                            'lewat' =>
                                $query->whereNull('tanggal_dikembalikan')
                                    ->whereDate('tanggal_kembali', '<', now()),

                            'pinjam' =>
                                $query->whereNull('tanggal_dikembalikan')
                                    ->whereDate('tanggal_kembali', '>=', now()),

                            default => $query,
                        };
                    }),

            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
