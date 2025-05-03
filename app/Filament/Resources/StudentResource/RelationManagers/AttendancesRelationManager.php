<?php

namespace App\Filament\Resources\StudentResource\RelationManagers;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AttendancesRelationManager extends RelationManager
{
    protected static string $relationship = 'attendances';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('attendance_date'),
                TextInput::make('school_hours'),
                TextInput::make('company_hours'),
                Select::make('school_id')
                    ->relationship('school', 'name')
                    ->default(function(){
                        return ($this->ownerRecord->getAttribute('school_id'));
                    })
                    ,
                Select::make('company_id')
                    ->relationship('company', 'name')
                    ->default(function(){
                        return ($this->ownerRecord->getAttribute('company_id'));
                    })
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('attendance_date')
            ->columns([
                Tables\Columns\TextColumn::make('attendance_date')->sortable(),
                TextColumn::make('school_hours'),
                TextColumn::make('company_hours'),
                TextColumn::make('company.name')
            ])
            ->filters([
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('attendance_date', 'desc')
            ;
    }
}
