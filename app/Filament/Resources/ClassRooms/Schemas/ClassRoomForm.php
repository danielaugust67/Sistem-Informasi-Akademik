<?php

namespace App\Filament\Resources\ClassRooms\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ClassRoomForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Select::make('subject_id')->relationship('subject', 'name')->label('Mata Pelajaran')->searchable()->preload()
                    ->required(),
                \Filament\Forms\Components\Select::make('semester_id')->relationship('semester', 'type')->label('Semester')->searchable()->preload()
                    ->required(),
                \Filament\Forms\Components\Select::make('rombel_id')->relationship('rombel', 'name')->label('Rombel')->searchable()->preload(),
                TextInput::make('capacity')
                    ->required()
                    ->numeric()
                    ->default(40),
                TextInput::make('room_code'),
            ]);
    }
}
