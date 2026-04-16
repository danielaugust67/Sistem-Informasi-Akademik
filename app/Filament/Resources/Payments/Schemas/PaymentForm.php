<?php

namespace App\Filament\Resources\Payments\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PaymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Select::make('student_id')->relationship('student', 'user.name')->label('Siswa/Mahasiswa')->searchable()->preload()
                    ->required(),
                \Filament\Forms\Components\Select::make('semester_id')->relationship('semester', 'type')->label('Semester')->searchable()->preload(),
                TextInput::make('total_amount')
                    ->required()
                    ->numeric(),
                TextInput::make('status')
                    ->required()
                    ->default('unpaid'),
                TextInput::make('invoice_no')
                    ->required(),
            ]);
    }
}
