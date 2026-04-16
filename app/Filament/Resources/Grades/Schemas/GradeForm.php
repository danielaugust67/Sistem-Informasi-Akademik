<?php

namespace App\Filament\Resources\Grades\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class GradeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Select::make('enrollment_id')->relationship('enrollment', 'id')->label('Data KRS/Daftar')->searchable()->preload()
                    ->required(),
                TextInput::make('total_score')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('letter_grade'),
            ]);
    }
}
