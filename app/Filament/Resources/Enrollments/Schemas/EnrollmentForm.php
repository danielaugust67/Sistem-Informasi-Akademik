<?php

namespace App\Filament\Resources\Enrollments\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EnrollmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Select::make('student_id')->relationship('student', 'user.name')->label('Siswa/Mahasiswa')->searchable()->preload()
                    ->required(),
                \Filament\Forms\Components\Select::make('class_room_id')->relationship('classRoom', 'room_code')->label('Ruang Kelas')->searchable()->preload()
                    ->required(),
                TextInput::make('status')
                    ->required()
                    ->default('pending'),
                DateTimePicker::make('enrolled_at')
                    ->required(),
            ]);
    }
}
