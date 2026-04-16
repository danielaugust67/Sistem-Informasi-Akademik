<?php

namespace App\Filament\Resources\StudentProfiles\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StudentProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Select::make('user_id')->relationship('user', 'name')->label('Nama Pengguna')->searchable()->preload()
                    ->required(),
                TextInput::make('nis_nim'),
                \Filament\Forms\Components\Select::make('study_program_id')->relationship('studyProgram', 'name')->label('Program Studi')->searchable()->preload(),
                \Filament\Forms\Components\Select::make('rombel_id')->relationship('rombel', 'name')->label('Rombel')->searchable()->preload(),
                \Filament\Forms\Components\Select::make('academic_advisor_id')->relationship('academicAdvisor', 'nip_nidn')->label('Dosen PA')->searchable()->preload(),
                TextInput::make('status')
                    ->required(),
                DatePicker::make('enrolled_at'),
            ]);
    }
}
