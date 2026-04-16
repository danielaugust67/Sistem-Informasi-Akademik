<?php

namespace App\Filament\Resources\Rombels\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RombelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Select::make('institution_id')->relationship('institution', 'name')->label('Institusi')->searchable()->preload()
                    ->required(),
                \Filament\Forms\Components\Select::make('academic_year_id')->relationship('academicYear', 'year')->label('Tahun Akademik')->searchable()->preload()
                    ->required(),
                TextInput::make('name')
                    ->required(),
                \Filament\Forms\Components\Select::make('homeroom_teacher_id')->relationship('homeroomTeacher', 'user.name')->label('Wali Kelas')->searchable()->preload(),
                TextInput::make('capacity')
                    ->required()
                    ->numeric()
                    ->default(30),
            ]);
    }
}
