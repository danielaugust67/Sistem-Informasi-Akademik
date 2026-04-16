<?php

namespace App\Filament\Resources\Attendances\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AttendanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Select::make('enrollment_id')->relationship('enrollment', 'id')->label('Data KRS/Daftar')->searchable()->preload()
                    ->required(),
                \Filament\Forms\Components\Select::make('schedule_id')->relationship('schedule', 'day_of_week')->label('Jadwal Hari')->searchable()->preload()
                    ->required(),
                DatePicker::make('date')
                    ->required(),
                TextInput::make('status')
                    ->required(),
                DateTimePicker::make('checked_at'),
            ]);
    }
}
