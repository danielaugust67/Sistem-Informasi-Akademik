<?php

namespace App\Filament\Resources\StudentProfiles\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StudentProfilesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->hidden()
                    ->label('ID'),
                TextColumn::make('user.name')->label('Nama Pengguna'),
                TextColumn::make('nis_nim')
                    ->searchable(),
                TextColumn::make('studyProgram.name')->label('Program Studi'),
                TextColumn::make('rombel.name')->label('Rombel'),
                TextColumn::make('academicAdvisor.nip_nidn')->label('Dosen PA'),
                TextColumn::make('status')
                    ->searchable(),
                TextColumn::make('enrolled_at')
                    ->date()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
