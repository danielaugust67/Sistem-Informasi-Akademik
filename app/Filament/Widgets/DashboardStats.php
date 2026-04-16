<?php

namespace App\Filament\Widgets;

use App\Models\StudentProfile;
use App\Models\TeacherProfile;
use App\Models\Rombel;
use App\Models\ClassRoom;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Siswa', StudentProfile::count())
                ->description('Jumlah seluruh siswa aktif')
                ->descriptionIcon('heroicon-m-users')
                ->color('success'),
            Stat::make('Total Guru', TeacherProfile::count())
                ->description('Tenaga pengajar terdaftar')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('warning'),
            Stat::make('Rombongan Belajar', Rombel::count())
                ->description('Total rombongan belajar (kelas)')
                ->descriptionIcon('heroicon-m-building-storefront')
                ->color('primary'),
            Stat::make('Ruang Kelas (KBM)', ClassRoom::count())
                ->description('Mata pelajaran berlangsung')
                ->descriptionIcon('heroicon-m-book-open')
                ->color('danger'),
        ];
    }
}