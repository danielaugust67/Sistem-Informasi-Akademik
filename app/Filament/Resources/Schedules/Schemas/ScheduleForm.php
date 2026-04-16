<?php

namespace App\Filament\Resources\Schedules\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class ScheduleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Select::make('class_room_id')->relationship('classRoom', 'room_code')->label('Ruang Kelas')->searchable()->preload()
                    ->required(),
                TextInput::make('day_of_week')
                    ->required(),
                TimePicker::make('start_time')
                    ->required(),
                TimePicker::make('end_time')
                    ->required(),
                TextInput::make('room_location'),
            ]);
    }
}
