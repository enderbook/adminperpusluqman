<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\Anggota;

class StatsDashboard extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $jmhpinjam = Peminjaman::count();
        $jmhbuku = Buku::count();
        $jmhanggota = Anggota::count();
        return [
            Stat::make('Total Peminjaman', $jmhpinjam),
            Stat::make('Jumlah Buku', $jmhbuku),
            Stat::make('Jumlah Anggota', $jmhanggota),
        ];
    }
}
