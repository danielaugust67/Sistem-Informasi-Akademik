<?php

namespace App\Filament\Resources\AcademicYears\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AcademicYearForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Select::make('institution_id')->relationship('institution', 'name')->label('Institusi')->searchable()->preload()
                    ->required(),
                TextInput::make('year')
                    ->required(),
                TextInput::make('status')
                    ->required()
                    ->default('planned'),
            ]);
    }
}
