<?php

namespace App\Filament\Resources\Institutions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class InstitutionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('type')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('settings'),
            ]);
    }
}
