<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Rombel;
use App\Models\StudentProfile;

class StudentRombelChart extends ChartWidget
{
    protected ?string $heading = 'Distribusi Siswa per Rombel';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $rombels = Rombel::all();
        
        $labels = [];
        $data = [];

        foreach ($rombels as $rombel) {
            $labels[] = $rombel->name;
            $data[] = StudentProfile::where('rombel_id', $rombel->id)->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Siswa',
                    'data' => $data,
                    'backgroundColor' => '#3b82f6', // Biru
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}