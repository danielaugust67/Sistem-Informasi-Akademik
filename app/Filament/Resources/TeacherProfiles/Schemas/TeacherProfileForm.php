<?php

namespace App\Filament\Resources\TeacherProfiles\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TeacherProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Select::make('user_id')->relationship('user', 'name')->label('Nama Pengguna')->searchable()->preload()
                    ->required(),
                TextInput::make('nip_nidn'),
                \Filament\Forms\Components\Select::make('department_id')->relationship('department', 'name')->label('Fakultas / Divisi')->searchable()->preload(),
                TextInput::make('specialization'),
            ]);
    }
}
