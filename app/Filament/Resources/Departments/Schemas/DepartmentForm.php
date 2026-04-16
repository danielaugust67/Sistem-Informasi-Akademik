<?php

namespace App\Filament\Resources\Departments\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DepartmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Select::make('institution_id')->relationship('institution', 'name')->label('Institusi')->searchable()->preload()
                    ->required(),
                TextInput::make('code'),
                TextInput::make('name')
                    ->required(),
            ]);
    }
}
