<?php

namespace App\Filament\Resources\Rombels;

use App\Filament\Resources\Rombels\Pages\CreateRombel;
use App\Filament\Resources\Rombels\Pages\EditRombel;
use App\Filament\Resources\Rombels\Pages\ListRombels;
use App\Filament\Resources\Rombels\Schemas\RombelForm;
use App\Filament\Resources\Rombels\Tables\RombelsTable;
use App\Models\Rombel;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RombelResource extends Resource
{
    protected static ?string $model = Rombel::class;

        protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;
    protected static \UnitEnum|string|null $navigationGroup = 'Akademik & Kurikulum';
    protected static ?string $modelLabel = 'Rombongan Belajar';
    protected static ?string $pluralModelLabel = 'Rombongan Belajar';

    public static function form(Schema $schema): Schema
    {
        return RombelForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RombelsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRombels::route('/'),
            'create' => CreateRombel::route('/create'),
            'edit' => EditRombel::route('/{record}/edit'),
        ];
    }
}
