<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Payment;

class PaymentStatusChart extends ChartWidget
{
    protected ?string $heading = 'Status Pembayaran SPP (Tagihan)';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $paid = Payment::where('status', 'paid')->count();
        $unpaid = Payment::where('status', 'unpaid')->count();

        return [
            'datasets' => [
                [
                    'label' => 'Status Tagihan',
                    'data' => [$paid, $unpaid],
                    'backgroundColor' => ['#10b981', '#ef4444'], // Hijau (Lunas), Merah (Belum)
                ],
            ],
            'labels' => ['Lunas (Paid)', 'Belum Lunas (Unpaid)'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}