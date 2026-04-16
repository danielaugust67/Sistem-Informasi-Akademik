<?php

namespace App\Filament\Resources\Subjects\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SubjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Select::make('institution_id')->relationship('institution', 'name')->label('Institusi')->searchable()->preload()
                    ->required(),
                \Filament\Forms\Components\Select::make('curriculum_id')->relationship('curriculum', 'name')->label('Kurikulum')->searchable()->preload(),
                \Filament\Forms\Components\Select::make('study_program_id')->relationship('studyProgram', 'name')->label('Program Studi')->searchable()->preload(),
                TextInput::make('code')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('credit_hours')
                    ->required()
                    ->numeric()
                    ->default(1),
                TextInput::make('level')
                    ->required(),
            ]);
    }
}
